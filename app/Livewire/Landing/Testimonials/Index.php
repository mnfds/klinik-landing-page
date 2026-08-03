<?php

namespace App\Livewire\Landing\Testimonials;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.landing')]
#[Title('Testimoni')]
class Index extends Component
{
    // Dummy data — nanti diganti Testimonial::with('service')->where('is_active', true)->latest()->get()
    protected function testimonials(): array
    {
        return [
            [
                'name' => 'Rahma Wulandari',
                'message' => 'Perawatan facial-nya bikin kulit terasa lebih cerah dan lembap. Dokternya juga menjelaskan dengan sabar sebelum treatment.',
                'rating' => 5,
                'service_name' => 'Facial Glow Signature',
            ],
            [
                'name' => 'Dian Kusuma',
                'message' => 'Awalnya ragu coba laser whitening, tapi ternyata prosesnya nyaman dan hasilnya terlihat bertahap sesuai yang dijanjikan.',
                'rating' => 5,
                'service_name' => 'Laser Whitening',
            ],
            [
                'name' => 'Putri Anggraini',
                'message' => 'Konsultasi dermatologi di sini enak, dokternya detail banget jelasin kondisi kulit saya sebelum kasih rekomendasi.',
                'rating' => 4,
                'service_name' => 'Konsultasi Dermatologi',
            ],
            [
                'name' => 'Sari Handayani',
                'message' => 'Tempatnya nyaman dan bersih, staff-nya ramah. Sudah langganan produk skincare-nya juga, cocok di kulit saya.',
                'rating' => 5,
                'service_name' => null,
            ],
            [
                'name' => 'Fajar Ramadhan',
                'message' => 'Penanganan jerawat medisnya cukup membantu, dalam beberapa minggu sudah terlihat perubahan yang signifikan.',
                'rating' => 4,
                'service_name' => 'Penanganan Jerawat Medis',
            ],
            [
                'name' => 'Novita Sari',
                'message' => 'Chemical peeling di sini hasilnya halus, tidak perih berlebihan, dan prosesnya cepat.',
                'rating' => 5,
                'service_name' => 'Chemical Peeling',
            ],
        ];
    }

    public function getTestimonialsListProperty(): array
    {
        return $this->testimonials();
    }

    public function render()
    {
        return view('livewire.landing.testimonials.index');
    }
}