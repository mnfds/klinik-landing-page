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
                'box' => asset('images/example/box.png'),
            ],
            [
                'title' => 'Paket Hemat Konsultasi + Skin Check-Up',
                'description' => 'Konsultasi dermatologi dan skin check-up dalam satu paket hemat.',
                'box' => asset('images/example/box.png'),
            ],
            [
                'title' => 'Buy 2 Get 1 Produk Skincare Pilihan',
                'description' => 'Berlaku untuk pembelian Hydrating Toner, Vitamin C Serum, dan Night Repair Cream.',
                'box' => asset('images/example/box.png'),
            ],
            [
                'title' => 'Diskon 35% Laser Rejuvenation',
                'description' => 'Potongan harga khusus untuk pelanggan baru kami.',
                'box' => asset('images/example/box.png'),
            ],
        ];
    }

    public function getFeaturedServicesProperty(): array
    {
        return [
            [
                'slug' => 'facial-glow-signature',
                'name' => 'Facial Glow Signature',
                'price' => 350000,
                'box' => asset('images/example/box.png')
            ],
            [
                'slug' => 'laser-whitening',
                'name' => 'Laser Whitening',
                'price' => 750000,
                'box' => asset('images/example/box.png')
            ],
            [
                'slug' => 'chemical-peeling',
                'name' => 'Chemical Peeling',
                'price' => 450000,
                'box' => asset('images/example/box.png')
            ],
            [
                'slug' => 'konsultasi-dermatologi',
                'name' => 'Konsultasi Dermatologi',
                'price' => 200000,
                'box' => asset('images/example/box.png')
            ],
            [
                'slug' => 'penanganan-jerawat-medis',
                'name' => 'Penanganan Jerawat Medis',
                'price' => 300000,
                'box' => asset('images/example/box.png')
            ],
            [
                'slug' => 'skin-check-up',
                'name' => 'Skin Check-Up',
                'price' => 150000,
                'box' => asset('images/example/box.png')
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
        ];
    }

    public function render()
    {
        return view('livewire.landing.home');
    }
}