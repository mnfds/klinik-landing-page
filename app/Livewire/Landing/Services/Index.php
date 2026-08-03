<?php

namespace App\Livewire\Landing\Services;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.landing')]
#[Title('Layanan')]
class Index extends Component
{
    public string $activeType = 'all';

    // Dummy data — nanti diganti Service::where('is_active', true)->get()
    protected function services(): array
    {
        return [
            [
                'slug' => 'facial-glow-signature',
                'name' => 'Facial Glow Signature',
                'type' => 'treatment',
                'description' => 'Perawatan facial dengan teknologi terkini untuk kulit tampak lebih cerah dan lembap.',
                'price' => 350000,
                'youtube_link' => null,
            ],
            [
                'slug' => 'laser-whitening',
                'name' => 'Laser Whitening',
                'type' => 'treatment',
                'description' => 'Mencerahkan area kulit tertentu dengan teknologi laser yang aman dan minim risiko.',
                'price' => 750000,
                'youtube_link' => 'https://youtube.com/watch?v=example',
            ],
            [
                'slug' => 'chemical-peeling',
                'name' => 'Chemical Peeling',
                'type' => 'treatment',
                'description' => 'Mengangkat sel kulit mati untuk regenerasi kulit yang lebih sehat dan halus.',
                'price' => 450000,
                'youtube_link' => null,
            ],
            [
                'slug' => 'konsultasi-dermatologi',
                'name' => 'Konsultasi Dermatologi',
                'type' => 'medical',
                'description' => 'Konsultasi kondisi kulit dengan dokter untuk penanganan masalah kulit non-estetika.',
                'price' => 200000,
                'youtube_link' => null,
            ],
            [
                'slug' => 'penanganan-jerawat-medis',
                'name' => 'Penanganan Jerawat Medis',
                'type' => 'medical',
                'description' => 'Diagnosis dan penanganan jerawat sedang-berat dengan pendekatan medis.',
                'price' => 300000,
                'youtube_link' => null,
            ],
            [
                'slug' => 'skin-check-up',
                'name' => 'Skin Check-Up',
                'type' => 'medical',
                'description' => 'Pemeriksaan menyeluruh kondisi kulit sebagai dasar rekomendasi perawatan lanjutan.',
                'price' => 150000,
                'youtube_link' => null,
            ],
        ];
    }

    public function setType(string $type): void
    {
        $this->activeType = $type;
    }

    public function getFilteredServicesProperty(): array
    {
        $all = $this->services();

        if ($this->activeType === 'all') {
            return $all;
        }

        return array_values(array_filter($all, fn ($s) => $s['type'] === $this->activeType));
    }

    public function render()
    {
        return view('livewire.landing.services.index');
    }
}
