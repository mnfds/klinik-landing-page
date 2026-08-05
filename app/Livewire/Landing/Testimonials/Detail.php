<?php

namespace App\Livewire\Landing\Testimonials;

use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Detail extends Component
{
    public array $testimonials;

    // Dummy data — nanti diganti Testimonials::where('slug', $slug)->firstOrFail()
    protected function testimonials(): array
    {
        return [
            [
                'name' => 'Rahma Wulandari',
                'message' => 'Perawatan facial-nya bikin kulit terasa lebih cerah dan lembap. Dokternya juga menjelaskan dengan sabar sebelum treatment.',
                'rating' => 5,
                'service_name' => 'Facial Glow Signature',
                'slug' => 'slug testi 1',
            ],
            [
                'name' => 'Dian Kusuma',
                'message' => 'Awalnya ragu coba laser whitening, tapi ternyata prosesnya nyaman dan hasilnya terlihat bertahap sesuai yang dijanjikan.',
                'rating' => 5,
                'service_name' => 'Laser Whitening',
                'slug' => 'slug testi 2',
            ],
            [
                'name' => 'Putri Anggraini',
                'message' => 'Konsultasi dermatologi di sini enak, dokternya detail banget jelasin kondisi kulit saya sebelum kasih rekomendasi.',
                'rating' => 4,
                'service_name' => 'Konsultasi Dermatologi',
                'slug' => 'slug testi 3',
            ],
            [
                'name' => 'Sari Handayani',
                'message' => 'Tempatnya nyaman dan bersih, staff-nya ramah. Sudah langganan produk skincare-nya juga, cocok di kulit saya.',
                'rating' => 5,
                'service_name' => null,
                'slug' => 'slug testi 4',
            ],
            [
                'name' => 'Fajar Ramadhan',
                'message' => 'Penanganan jerawat medisnya cukup membantu, dalam beberapa minggu sudah terlihat perubahan yang signifikan.',
                'rating' => 4,
                'service_name' => 'Penanganan Jerawat Medis',
                'slug' => 'slug testi 5',    
            ],
            [
                'name' => 'Novita Sari',
                'message' => 'Chemical peeling di sini hasilnya halus, tidak perih berlebihan, dan prosesnya cepat.',
                'rating' => 5,
                'service_name' => 'Chemical Peeling',
                'slug' => 'slug testi 5',
            ],
        ];
    }

    public function mount(string $slug): void
    {
        $testimonials = collect($this->testimonials())->firstWhere('slug', $slug);

        abort_if($testimonials === null, 404);

        $this->testimonials = $testimonials;
    }

    #[Layout('layouts.landing')]
    #[Title('Detail Testimonials')]

    public function render()
    {
        return view('livewire.landing.testimonials.detail');
    }
}
