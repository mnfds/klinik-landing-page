<?php

namespace App\Livewire\Admin\Doctors;

use App\Models\Doctors;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public bool $show = false;

    public string $name = '';
    public string $specialization = '';
    public string $bio = '';
    public $photo;
    public bool $is_active = true;

    /** @var array<int, array{day: string, start_time: string, end_time: string, is_active: bool}> */
    public array $schedules = [];

    public array $dayOptions = [
        'senin' => 'Senin',
        'selasa' => 'Selasa',
        'rabu' => 'Rabu',
        'kamis' => 'Kamis',
        'jumat' => 'Jumat',
        'sabtu' => 'Sabtu',
        'minggu' => 'Minggu',
    ];

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'schedules' => 'nullable|array',
            'schedules.*.day' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'schedules.*.start_time' => 'required',
            'schedules.*.end_time' => 'required',
            'schedules.*.is_active' => 'boolean',
        ];
    }

    protected function messages(): array
    {
        return [
            'schedules.*.day.required' => 'Hari wajib dipilih.',
            'schedules.*.start_time.required' => 'Jam mulai wajib diisi.',
            'schedules.*.end_time.required' => 'Jam selesai wajib diisi.',
        ];
    }

    #[On('open-create-doctor-modal')]
    public function openModal(): void
    {
        $this->resetForm();
        $this->show = true;
    }

    public function closeModal(): void
    {
        $this->show = false;
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->reset(['name', 'specialization', 'bio', 'photo', 'schedules']);
        $this->is_active = true;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function addSchedule(): void
    {
        $this->schedules[] = [
            'day' => '',
            'start_time' => '',
            'end_time' => '',
            'is_active' => true,
        ];
    }

    public function removeSchedule(int $index): void
    {
        unset($this->schedules[$index]);
        $this->schedules = array_values($this->schedules);
    }

    private function validateScheduleTimes(): bool
    {
        $valid = true;

        foreach ($this->schedules as $index => $schedule) {
            if (! empty($schedule['start_time']) && ! empty($schedule['end_time'])
                && $schedule['end_time'] <= $schedule['start_time']) {
                $this->addError("schedules.$index.end_time", 'Jam selesai harus lebih besar dari jam mulai.');
                $valid = false;
            }
        }

        return $valid;
    }

    public function save(): void
    {
        $validated = $this->validate();
        try {
            if (! $this->validateScheduleTimes()) {
                return;
            }
    
            if ($this->photo) {
                $validated['photo'] = $this->photo->store('doctors', 'public');
            } else {
                unset($validated['photo']);
            }
    
            $schedules = $validated['schedules'] ?? [];
            unset($validated['schedules']);
    
            $doctor = Doctors::create($validated);
    
            foreach ($schedules as $schedule) {
                $doctor->schedules()->create($schedule);
            }
    
            $this->closeModal();
            $this->dispatch('doctorSaved');
            $this->dispatch('toast', type: 'success', message: 'Dokter berhasil disimpan.');
        } catch (\Throwable $th) {
            $this->dispatch('toast', type: 'error', message: 'Gagal menyimpan dokter. silahkan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.admin.doctors.create');
    }
}