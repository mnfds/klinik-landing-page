<?php

namespace App\Livewire\Landing\Products;

use App\Models\Products;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.landing')]
#[Title('Detail Produk')]
class Detail extends Component
{
    public Products $product;

    public function mount(Products $product): void
    {
        abort_unless($product->is_active, 404);

        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.landing.products.detail');
    }
}