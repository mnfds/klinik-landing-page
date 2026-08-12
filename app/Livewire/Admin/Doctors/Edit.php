<?php

namespace App\Livewire\Admin\Doctors;

use App\Models\Doctors;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public bool $show = false;
    public ?int $doctorId = null;

    public string $name = '';
    public string $specialization = '';
    public string $bio = '';
    public $photo;
    public ?string $existingPhoto = null;
    public bool $is_active = true;

    /** @var array<int, array{id: ?int, day: string, start_time: string, end_time: string, is_active: bool}> */
    public array $schedules = [];

    /** @var int[] id jadwal lama yang dihapus user di UI, akan di-delete saat save */
    public array $removedScheduleIds = [];

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
            'schedules.*.id' => 'nullable|integer|exists:doctor_schedules,id',
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

    #[On('open-edit-doctor-modal')]
    public function openModal(int $id): void
    {
        $doctor = Doctors::with('schedules')->findOrFail($id);

        $this->doctorId = $doctor->id;
        $this->name = $doctor->name;
        $this->specialization = $doctor->specialization;
        $this->bio = (string) $doctor->bio;
        $this->existingPhoto = $doctor->photo;
        $this->photo = null;
        $this->is_active = $doctor->is_active;

        $this->schedules = $doctor->schedules->map(fn ($s) => [
            'id' => $s->id,
            'day' => $s->day,
            'start_time' => substr((string) $s->start_time, 0, 5), // HH:MM untuk input time
            'end_time' => substr((string) $s->end_time, 0, 5),
            'is_active' => $s->is_active,
        ])->toArray();

        $this->removedScheduleIds = [];

        $this->resetErrorBag();
        $this->resetValidation();
        $this->show = true;
    }

    public function closeModal(): void
    {
        $this->show = false;
        $this->reset(['doctorId', 'name', 'specialization', 'bio', 'photo', 'existingPhoto', 'schedules', 'removedScheduleIds']);
        $this->is_active = true;
    }

    public function addSchedule(): void
    {
        $this->schedules[] = [
            'id' => null,
            'day' => '',
            'start_time' => '',
            'end_time' => '',
            'is_active' => true,
        ];
    }

    public function removeSchedule(int $index): void
    {
        if (! empty($this->schedules[$index]['id'])) {
            $this->removedScheduleIds[] = $this->schedules[$index]['id'];
        }

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
    
            $doctor = Doctors::findOrFail($this->doctorId);
    
            if ($this->photo) {
                if ($doctor->photo) {
                    Storage::disk('public')->delete($doctor->photo);
                }
                $validated['photo'] = $this->photo->store('doctors', 'public');
            } else {
                unset($validated['photo']);
            }
    
            $schedules = $validated['schedules'] ?? [];
            unset($validated['schedules']);
    
            $doctor->update($validated);
    
            // hapus jadwal yang dibuang user di UI
            if (! empty($this->removedScheduleIds)) {
                $doctor->schedules()->whereIn('id', $this->removedScheduleIds)->delete();
            }
    
            // update existing / create baru
            foreach ($schedules as $schedule) {
                $scheduleId = $schedule['id'] ?? null;
                unset($schedule['id']);
    
                if ($scheduleId) {
                    $doctor->schedules()->where('id', $scheduleId)->update($schedule);
                } else {
                    $doctor->schedules()->create($schedule);
                }
            }
    
            $this->closeModal();
            $this->dispatch('doctorSaved');
            $this->dispatch('toast', type: 'success', message: 'Dokter berhasil diperbarui.');
        } catch (\Throwable $th) {
            $this->dispatch('toast', type: 'error', message: 'Gagal memperbarui dokter. silahkan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.admin.doctors.edit');
    }
}