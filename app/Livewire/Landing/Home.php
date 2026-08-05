<?php

namespace App\Livewire\Landing;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.landing')]
#[Title('Beranda')]
class Home extends Component
{
    // Dummy data — nanti diganti Promo::where('is_active', true)->limit(3)->get()
    public function getPromosProperty(): array
    {
        return [
            [
                'title' => 'Diskon 20% Facial Glow Signature',
                'description' => 'Potongan harga khusus untuk treatment facial andalan kami.',
                'landscape' => asset('images/example/landscape.png'),
                'box' => asset('images/example/box.png'),
            ],
            [
                'title' => 'Paket Hemat Konsultasi + Skin Check-Up',
                'description' => 'Konsultasi dermatologi dan skin check-up dalam satu paket hemat.',
                'landscape' => asset('images/example/landscape.png'),
                'box' => asset('images/example/box.png'),
            ],
            [
                'title' => 'Buy 2 Get 1 Produk Skincare Pilihan',
                'description' => 'Berlaku untuk pembelian Hydrating Toner, Vitamin C Serum, dan Night Repair Cream.',
                'landscape' => asset('images/example/landscape.png'),
                'box' => asset('images/example/box.png'),
            ],
        ];
    }

    // Dummy data — nanti diganti Product::where('is_active', true)->orderBy('order')->limit(4)->get()
    public function getFeaturedProductsProperty(): array
    {
        return [
            ['slug' => 'hydrating-toner', 'name' => 'Hydrating Toner', 'price' => 145000, 'box' => asset('images/example/box.png')],
            ['slug' => 'vitamin-c-serum', 'name' => 'Vitamin C Serum', 'price' => 210000, 'box' => asset('images/example/box.png')],
            ['slug' => 'sunscreen-spf-50', 'name' => 'Sunscreen SPF 50', 'price' => 165000, 'box' => asset('images/example/box.png')],
            ['slug' => 'night-repair-cream', 'name' => 'Night Repair Cream', 'price' => 235000, 'box' => asset('images/example/box.png')],
            ['slug' => 'hydrating-toner', 'name' => 'Hydrating Toner', 'price' => 145000, 'box' => asset('images/example/box.png')],
            ['slug' => 'vitamin-c-serum', 'name' => 'Vitamin C Serum', 'price' => 210000, 'box' => asset('images/example/box.png')],
        ];
    }

    // Dummy data — nanti diganti Testimonial::where('is_active', true)->latest()->limit(3)->get()
    public function getFeaturedTestimonialsProperty(): array
    {
        return [
            [
                'name' => 'Rahma Wulandari',
                'message' => 'Perawatan facial-nya bikin kulit terasa lebih cerah dan lembap. Dokternya juga menjelaskan dengan sabar.',
                'rating' => 5,
            ],
            [
                'name' => 'Dian Kusuma',
                'message' => 'Awalnya ragu coba laser whitening, tapi prosesnya nyaman dan hasilnya terlihat bertahap.',
                'rating' => 5,
            ],
            [
                'name' => 'Putri Anggraini',
                'message' => 'Konsultasi dermatologi di sini enak, dokternya detail banget jelasin kondisi kulit saya.',
                'rating' => 4,
            ],
        ];
    }

    public function render()
    {
        return view('livewire.landing.home');
    }
}