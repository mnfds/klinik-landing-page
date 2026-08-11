<?php

namespace App\Livewire\Landing;

use App\Models\BannerHome;
use App\Models\Doctors;
use App\Models\Products;
use App\Models\Promos;
use App\Models\Services;
use App\Models\Testimonials;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.landing')]
#[Title('Beranda')]
class Home extends Component
{
    public function getPromosProperty(): Collection
    {
        return Promos::query()
            ->where('is_active', true)
            ->where(fn ($q) => $q->whereNull('end_date')->orWhereDate('end_date', '>=', now()))
            ->orderByDesc('start_date')
            ->limit(4)
            ->get();
    }

    public function formatPeriod(?Carbon $start, ?Carbon $end): string
    {
        if (! $start && ! $end) {
            return 'Berlaku hingga pemberitahuan selanjutnya';
        }

        $startLabel = $start?->translatedFormat('d M Y');
        $endLabel = $end?->translatedFormat('d M Y') ?? 'seterusnya';

        return "{$startLabel} – {$endLabel}";
    }

    public function getFeaturedServicesProperty(): Collection
    {
        return Services::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->limit(6)
            ->get();
    }

    public function getFeaturedProductsProperty(): Collection
    {
        return Products::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->limit(6)
            ->get();
    }

    public function getFeaturedBannerProperty(): Collection
    {
        return BannerHome::query()
            ->where('is_active', true)
            ->latest()
            ->get();
    }

    public function getFeaturedTestimonialsProperty(): Collection
    {
        return Testimonials::query()
            ->where('is_active', true)
            ->latest()
            ->limit(3)
            ->get();
    }

    public function getFeaturedDoctorsProperty(): Collection
    {
        return Doctors::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->limit(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.landing.home');
    }
}