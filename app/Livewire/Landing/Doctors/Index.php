<?php

namespace App\Livewire\Landing\Doctors;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.landing')]
#[Title('Dokter & Jadwal Praktik')]
class Index extends Component
{
    protected array $dayOrder = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];

    protected array $dayLabels = [
        'senin' => 'Senin',
        'selasa' => 'Selasa',
        'rabu' => 'Rabu',
        'kamis' => 'Kamis',
        'jumat' => 'Jumat',
        'sabtu' => 'Sabtu',
        'minggu' => 'Minggu',
    ];

    // Dummy data — nanti diganti Doctor::with('schedules')->where('is_active', true)->orderBy('order')->get()
    protected function doctors(): array
    {
        return [
            [
                'name' => 'dr. Amelia Putri, Sp.KK',
                'specialization' => 'Spesialis Kulit & Kelamin',
                'bio' => 'Berpengalaman lebih dari 8 tahun dalam penanganan masalah kulit medis dan estetika.',
                'schedules' => [
                    ['day' => 'senin', 'start_time' => '09:00', 'end_time' => '15:00'],
                    ['day' => 'rabu', 'start_time' => '09:00', 'end_time' => '15:00'],
                    ['day' => 'jumat', 'start_time' => '13:00', 'end_time' => '18:00'],
                ],
            ],
            [
                'name' => 'dr. Bagas Wirawan',
                'specialization' => 'Dokter Umum & Estetika',
                'bio' => 'Menangani konsultasi umum serta treatment estetika non-bedah dengan pendekatan yang personal.',
                'schedules' => [
                    ['day' => 'selasa', 'start_time' => '10:00', 'end_time' => '16:00'],
                    ['day' => 'kamis', 'start_time' => '10:00', 'end_time' => '16:00'],
                    ['day' => 'sabtu', 'start_time' => '09:00', 'end_time' => '14:00'],
                ],
            ],
            [
                'name' => 'dr. Citra Dewanti, Sp.DV',
                'specialization' => 'Spesialis Dermatovenereologi',
                'bio' => 'Fokus pada penanganan jerawat, alergi kulit, dan kondisi kulit kronis lainnya.',
                'schedules' => [
                    ['day' => 'senin', 'start_time' => '15:30', 'end_time' => '20:00'],
                    ['day' => 'kamis', 'start_time' => '15:30', 'end_time' => '20:00'],
                ],
            ],
        ];
    }

    public function getDoctorsListProperty(): array
    {
        return $this->doctors();
    }

    public function dayLabel(string $day): string
    {
        return $this->dayLabels[$day] ?? ucfirst($day);
    }

    public function sortedSchedules(array $schedules): array
    {
        usort($schedules, fn ($a, $b) => array_search($a['day'], $this->dayOrder) <=> array_search($b['day'], $this->dayOrder));

        return $schedules;
    }

    public function render()
    {
        return view('livewire.landing.doctors.index');
    }
}