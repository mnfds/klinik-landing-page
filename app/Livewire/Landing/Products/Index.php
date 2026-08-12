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
    public string $search = '';
    
    public function getProductsListProperty(): Collection
    {
        return Products::query()
            ->where('is_active', true)
            ->when(
                filled(trim($this->search)),
                fn ($q) => $q->where(
                    'name',
                    'like',
                    '%' . trim($this->search) . '%'
                )
            )
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