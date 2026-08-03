<?php

namespace App\Livewire\Landing\Promos;

use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.landing')]
#[Title('Promo')]
class Index extends Component
{
    // Dummy data — nanti diganti Promo::where('is_active', true)
    //   ->where(fn ($q) => $q->whereNull('end_date')->orWhere('end_date', '>=', now()))
    //   ->orderBy('start_date', 'desc')->get()
    protected function promos(): array
    {
        return [
            [
                'title' => 'Diskon 20% Facial Glow Signature',
                'description' => 'Nikmati potongan harga khusus untuk treatment facial andalan kami, berlaku untuk kunjungan pertama.',
                'start_date' => '2026-08-01',
                'end_date' => '2026-08-31',
            ],
            [
                'title' => 'Paket Hemat Konsultasi + Skin Check-Up',
                'description' => 'Konsultasi dermatologi dan skin check-up dalam satu paket dengan harga lebih hemat.',
                'start_date' => '2026-07-15',
                'end_date' => '2026-08-10',
            ],
            [
                'title' => 'Buy 2 Get 1 Produk Skincare Pilihan',
                'description' => 'Berlaku untuk pembelian Hydrating Toner, Vitamin C Serum, dan Night Repair Cream.',
                'start_date' => '2026-08-01',
                'end_date' => null,
            ],
        ];
    }

    public function getPromosListProperty(): array
    {
        return collect($this->promos())
            ->map(function ($promo) {
                $promo['is_ending_soon'] = $promo['end_date']
                    ? Carbon::parse($promo['end_date'])->diffInDays(now(), false) >= -7 && Carbon::parse($promo['end_date'])->isFuture()
                    : false;

                return $promo;
            })
            ->toArray();
    }

    public function formatPeriod(?string $start, ?string $end): string
    {
        if (! $start && ! $end) {
            return 'Berlaku hingga pemberitahuan selanjutnya';
        }

        $startLabel = $start ? Carbon::parse($start)->translatedFormat('d M Y') : null;
        $endLabel = $end ? Carbon::parse($end)->translatedFormat('d M Y') : 'seterusnya';

        return "{$startLabel} – {$endLabel}";
    }

    public function render()
    {
        return view('livewire.landing.promos.index');
    }
}