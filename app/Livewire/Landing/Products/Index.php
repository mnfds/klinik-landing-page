<?php

namespace App\Livewire\Landing\Products;

use App\Models\BannerPage;
use App\Models\Products;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.landing')]
#[Title('Produk')]
class Index extends Component
{
    public function getProductsListProperty(): Collection
    {
        return Products::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    public function getBannerProperty(): ?BannerPage
    {
        return BannerPage::query()
            ->where('type', 'products')
            ->where('is_active', true)
            ->first();
    }

    public function render()
    {
        return view('livewire.landing.products.index');
    }
}