<?php

namespace App\Livewire\Landing\Reservasi;

use App\Services\SiklinikApi;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.landing')] // samakan dengan atribut Layout di komponen landing lainnya
#[Title('Reservasi Online')]
class Create extends Component
{
    public string $nama = '';
    public string $no_telp = '';
    public string $status_pasien = 'baru'; // baru | lama
    public string $no_register = '';
    public string $nik = '';
    public string $poli_id = '';
    public string $dokter_id = '';
    public string $tanggal_reservasi = '';
    public string $jam_reservasi = '';
    public string $catatan = '';

    public bool $sukses = false;
    public ?string $pesanError = null;

    #[Computed]
    public function polis(): array
    {
        try {
            return app(SiklinikApi::class)->poliklinik();
        } catch (\Throwable $e) {
            report($e);
            return [];
        }
    }

    #[Computed]
    public function dokters(): array
    {
        if ($this->poli_id === '') {
            return [];
        }

        try {
            return app(SiklinikApi::class)->dokter((int) $this->poli_id);
        } catch (\Throwable $e) {
            report($e);
            return [];
        }
    }

    public function updatedPoliId(): void
    {
        $this->reset('dokter_id');
        $this->resetValidation(['poli_id', 'dokter_id']);
    }

    protected function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'no_telp' => ['required', 'regex:/^[0-9+\-\s]{8,20}$/'],
            'status_pasien' => ['required', 'in:baru,lama'],
            'no_register' => ['nullable', 'string', 'max:255'],
            'nik' => ['nullable', 'digits:16'],
            'poli_id' => ['required', 'integer'],
            'dokter_id' => ['nullable', 'integer'],
            'tanggal_reservasi' => [
                'required', 'date', 'after_or_equal:today',
                'before_or_equal:' . now()->addMonths(2)->toDateString(),
            ],
            'jam_reservasi' => ['nullable', 'date_format:H:i'],
            'catatan' => ['nullable', 'string', 'max:1000'],
        ];
    }

    protected function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'no_telp.required' => 'Nomor HP wajib diisi.',
            'no_telp.regex' => 'Format nomor HP tidak valid.',
            'poli_id.required' => 'Poliklinik wajib dipilih.',
            'tanggal_reservasi.required' => 'Tanggal kunjungan wajib diisi.',
            'tanggal_reservasi.after_or_equal' => 'Tanggal kunjungan tidak boleh di masa lalu.',
            'tanggal_reservasi.before_or_equal' => 'Tanggal kunjungan maksimal 2 bulan ke depan.',
            'jam_reservasi.date_format' => 'Format jam tidak valid.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit angka.',
        ];
    }

    public function kirim(SiklinikApi $api): void
    {
        $this->pesanError = null;
        $this->nik = preg_replace('/\D/', '', $this->nik);
        $this->validate();

        $kunci = 'reservasi:' . request()->ip();

        if (RateLimiter::tooManyAttempts($kunci, 3)) {
            $this->pesanError = 'Terlalu banyak percobaan. Mohon tunggu '
                . RateLimiter::availableIn($kunci) . ' detik lalu coba lagi.';
            return;
        }

        RateLimiter::hit($kunci, 60);

        $payload = [
            'nama' => $this->nama,
            'no_telp' => $this->no_telp,
            'pasien_baru' => $this->status_pasien === 'baru',
            'no_register' => $this->status_pasien === 'lama' && $this->no_register !== '' ? $this->no_register : null,
            'no_register' => $this->status_pasien === 'lama' && $this->no_register !== '' ? $this->no_register : null,
            'nik' => $this->nik !== '' ? $this->nik : null,
            'poli_id' => (int) $this->poli_id,
            'dokter_id' => $this->dokter_id !== '' ? (int) $this->dokter_id : null,
            'tanggal_reservasi' => $this->tanggal_reservasi,
            'jam_reservasi' => $this->jam_reservasi !== '' ? $this->jam_reservasi : null,
            'catatan' => $this->catatan !== '' ? $this->catatan : null,
        ];

        try {
            $res = $api->kirimReservasi($payload);
        } catch (ConnectionException $e) {
            report($e);
            $this->pesanError = 'Layanan reservasi sedang tidak dapat dihubungi. Silakan coba lagi nanti atau hubungi kami via WhatsApp.';
            return;
        }

        if ($res->successful()) {
            $this->reset([
                'nama', 'no_telp', 'status_pasien', 'no_register', 'poli_id',
                'dokter_id', 'tanggal_reservasi', 'jam_reservasi', 'catatan',
            ]);
            $this->sukses = true;
            $this->js("window.scrollTo({ top: 0, behavior: 'smooth' })");
            return;
        }

        switch ($res->status()) {
            case 422:
                foreach ($res->json('errors', []) as $field => $pesan) {
                    $this->addError($field === 'pasien_baru' ? 'status_pasien' : $field, $pesan[0]);
                }
                $this->pesanError = 'Periksa kembali isian Anda.';
                break;
            case 409:
                $this->pesanError = $res->json('message') ?? 'Permintaan serupa sudah pernah dikirim.';
                break;
            case 429:
                $this->pesanError = 'Terlalu banyak percobaan. Mohon tunggu sebentar lalu coba lagi.';
                break;
            default:
                report(new \RuntimeException('SIKLINIK API error: ' . $res->status()));
                $this->pesanError = 'Terjadi kesalahan. Silakan coba lagi atau hubungi kami via WhatsApp.';
        }
    }

    public function kirimLagi(): void
    {
        $this->sukses = false;
        $this->pesanError = null;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.landing.reservasi.create');
    }
}