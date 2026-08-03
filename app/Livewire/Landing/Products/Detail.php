<?php

namespace App\Livewire\Landing\Products;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Detail extends Component
{
    public array $product;

    // Dummy data — nanti diganti Product::where('slug', $slug)->firstOrFail()
    protected function products(): array
    {
        return [
            [
                'slug' => 'gentle-cleansing-foam',
                'name' => 'Gentle Cleansing Foam',
                'description' => 'Pembersih wajah lembut dengan pH seimbang, cocok untuk semua jenis kulit termasuk kulit sensitif. Diformulasikan tanpa sulfat keras sehingga tidak membuat kulit terasa ketarik setelah dipakai.',
                'price' => 125000,
            ],
            [
                'slug' => 'hydrating-toner',
                'name' => 'Hydrating Toner',
                'description' => 'Toner dengan kandungan hyaluronic acid untuk menjaga kelembapan kulit sepanjang hari. Membantu menyiapkan kulit sebelum pemakaian serum agar penyerapan lebih maksimal.',
                'price' => 145000,
            ],
            [
                'slug' => 'vitamin-c-serum',
                'name' => 'Vitamin C Serum',
                'description' => 'Serum pencerah dengan vitamin C stabil untuk membantu meratakan warna kulit dan melindungi dari radikal bebas. Disarankan dipakai pada pagi hari sebelum sunscreen.',
                'price' => 210000,
            ],
            [
                'slug' => 'sunscreen-spf-50',
                'name' => 'Sunscreen SPF 50',
                'description' => 'Tabir surya ringan dengan formula tidak lengket, cocok dipakai sehari-hari di bawah makeup. Memberikan perlindungan UVA/UVB tanpa meninggalkan white cast.',
                'price' => 165000,
            ],
            [
                'slug' => 'night-repair-cream',
                'name' => 'Night Repair Cream',
                'description' => 'Krim malam dengan retinol dosis rendah untuk membantu regenerasi kulit selama tidur. Cocok untuk pemula yang baru mulai menggunakan retinol.',
                'price' => 235000,
            ],
            [
                'slug' => 'acne-spot-treatment',
                'name' => 'Acne Spot Treatment',
                'description' => 'Perawatan titik untuk jerawat aktif, membantu mengurangi kemerahan dan mempercepat penyembuhan. Cukup dioleskan tipis pada area yang berjerawat.',
                'price' => 95000,
            ],
        ];
    }

    public function mount(string $slug): void
    {
        $product = collect($this->products())->firstWhere('slug', $slug);

        abort_if($product === null, 404);

        $this->product = $product;
    }

    #[Layout('layouts.landing')]
    #[Title('Detail Produk')]
    public function render()
    {
        return view('livewire.landing.products.detail');
    }
}
