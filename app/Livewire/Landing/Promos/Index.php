<?php

namespace App\Livewire\Landing\Promos;

use App\Models\BannerPage;
use App\Models\Promos;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.landing')]
#[Title('Promo')]
class Index extends Component
{
    public function getPromosListProperty(): Collection
    {
        return Promos::query()
            ->where('is_active', true)
            ->where(fn ($q) => $q->whereNull('end_date')->orWhereDate('end_date', '>=', now()))
            ->orderByDesc('start_date')
            ->get()
            ->map(function ($promo) {
                $promo->is_ending_soon = $promo->end_date
                    ? $promo->end_date->isFuture() && $promo->end_date->diffInDays(now(), false) >= -7
                    : false;

                return $promo;
            });
    }

    public function getBannerProperty(): ?BannerPage
    {
        return BannerPage::query()
            ->where('type', 'promos')
            ->where('is_active', true)
            ->first();
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

    public function render()
    {
        return view('livewire.landing.promos.index');
    }
}