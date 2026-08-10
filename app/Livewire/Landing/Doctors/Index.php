<?php

namespace App\Livewire\Landing\Doctors;

use App\Models\BannerPage;
use App\Models\Doctors;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
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

    public function getDoctorsListProperty(): Collection
    {
        return Doctors::query()
            ->with(['schedules' => fn ($q) => $q->where('is_active', true)])
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    public function getBannerProperty(): ?BannerPage
    {
        return BannerPage::query()
            ->where('type', 'doctors')
            ->where('is_active', true)
            ->first();
    }

    public function dayLabel(string $day): string
    {
        return $this->dayLabels[$day] ?? ucfirst($day);
    }

    public function sortedSchedules($schedules): \Illuminate\Support\Collection
    {
        return collect($schedules)->sortBy(
            fn ($schedule) => array_search($schedule->day, $this->dayOrder)
        )->values();
    }

    public function formatTime(?string $time): string
    {
        return $time ? Carbon::parse($time)->format('H:i') : '';
    }

    public function render()
    {
        return view('livewire.landing.doctors.index');
    }
}