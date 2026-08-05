<?php

namespace App\Livewire\Landing\Products;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.landing')]
#[Title('Produk')]
class Index extends Component
{
    // Dummy data — nanti diganti Product::where('is_active', true)->orderBy('order')->get()
    protected function products(): array
    {
        return [
            [
                'slug' => 'gentle-cleansing-foam',
                'name' => 'Gentle Cleansing Foam',
                'description' => 'Pembersih wajah lembut dengan pH seimbang, cocok untuk semua jenis kulit termasuk kulit sensitif.',
                'price' => 125000,
                'box' => asset('images/example/box.png')
            ],
            [
                'slug' => 'hydrating-toner',
                'name' => 'Hydrating Toner',
                'description' => 'Toner dengan kandungan hyaluronic acid untuk menjaga kelembapan kulit sepanjang hari.',
                'price' => 145000,
                'box' => asset('images/example/box.png')
            ],
            [
                'slug' => 'vitamin-c-serum',
                'name' => 'Vitamin C Serum',
                'description' => 'Serum pencerah dengan vitamin C stabil untuk membantu meratakan warna kulit dan melindungi dari radikal bebas.',
                'price' => 210000,
                'box' => asset('images/example/box.png')
            ],
            [
                'slug' => 'sunscreen-spf-50',
                'name' => 'Sunscreen SPF 50',
                'description' => 'Tabir surya ringan dengan formula tidak lengket, cocok dipakai sehari-hari di bawah makeup.',
                'price' => 165000,
                'box' => asset('images/example/box.png')
            ],
            [
                'slug' => 'night-repair-cream',
                'name' => 'Night Repair Cream',
                'description' => 'Krim malam dengan retinol dosis rendah untuk membantu regenerasi kulit selama tidur.',
                'price' => 235000,
                'box' => asset('images/example/box.png')
            ],
            [
                'slug' => 'acne-spot-treatment',
                'name' => 'Acne Spot Treatment',
                'description' => 'Perawatan titik untuk jerawat aktif, membantu mengurangi kemerahan dan mempercepat penyembuhan.',
                'price' => 95000,
                'box' => asset('images/example/box.png')
            ],
        ];
    }

    public function getProductsListProperty(): array
    {
        return $this->products();
    }

    public function render()
    {
        return view('livewire.landing.products.index');
    }
}
