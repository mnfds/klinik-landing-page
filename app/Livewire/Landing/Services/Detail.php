<?php

namespace App\Livewire\Landing\Services;

use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Detail extends Component
{
    public array $service;

    // Dummy data — nanti diganti Service::where('slug', $slug)->firstOrFail()
    protected function services(): array
    {
        return [
            [
                'slug' => 'facial-glow-signature',
                'name' => 'Facial Glow Signature',
                'type' => 'treatment',
                'description' => 'Perawatan facial dengan teknologi terkini untuk kulit tampak lebih cerah dan lembap. Cocok untuk kulit kusam dan dehidrasi, menggunakan serum aktif yang diserap lebih dalam lewat teknik infus oksigen.',
                'price' => 350000,
                'youtube_link' => null,
            ],
            [
                'slug' => 'laser-whitening',
                'name' => 'Laser Whitening',
                'type' => 'treatment',
                'description' => 'Mencerahkan area kulit tertentu dengan teknologi laser yang aman dan minim risiko, ditangani langsung oleh dokter dengan sertifikasi resmi.',
                'price' => 750000,
                'youtube_link' => 'https://youtube.com/watch?v=example',
            ],
            [
                'slug' => 'chemical-peeling',
                'name' => 'Chemical Peeling',
                'type' => 'treatment',
                'description' => 'Mengangkat sel kulit mati untuk regenerasi kulit yang lebih sehat dan halus, membantu mengatasi tekstur kulit tidak rata dan bekas jerawat ringan.',
                'price' => 450000,
                'youtube_link' => null,
            ],
            [
                'slug' => 'konsultasi-dermatologi',
                'name' => 'Konsultasi Dermatologi',
                'type' => 'medical',
                'description' => 'Konsultasi kondisi kulit dengan dokter untuk penanganan masalah kulit non-estetika, termasuk diagnosis awal dan rencana perawatan lanjutan.',
                'price' => 200000,
                'youtube_link' => null,
            ],
            [
                'slug' => 'penanganan-jerawat-medis',
                'name' => 'Penanganan Jerawat Medis',
                'type' => 'medical',
                'description' => 'Diagnosis dan penanganan jerawat sedang-berat dengan pendekatan medis, termasuk resep obat topikal atau oral sesuai kebutuhan.',
                'price' => 300000,
                'youtube_link' => null,
            ],
            [
                'slug' => 'skin-check-up',
                'name' => 'Skin Check-Up',
                'type' => 'medical',
                'description' => 'Pemeriksaan menyeluruh kondisi kulit sebagai dasar rekomendasi perawatan lanjutan, cocok dilakukan sebelum memulai treatment apapun.',
                'price' => 150000,
                'youtube_link' => null,
            ],
        ];
    }

    public function mount(string $slug): void
    {
        $service = collect($this->services())->firstWhere('slug', $slug);

        abort_if($service === null, 404);

        $this->service = $service;
    }

    #[Layout('layouts.landing')]
    #[Title('Detail Layanan')]
    public function render()
    {
        return view('livewire.landing.services.detail');
    }
}
