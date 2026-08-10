<?php

namespace App\Livewire\Landing\Testimonials;

use App\Models\Testimonials as TestimonialsModel;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.landing')]
#[Title('Testimoni')]
class Index extends Component
{
    public function getTestimonialsListProperty(): Collection
    {
        return TestimonialsModel::query()
            ->where('is_active', true)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.landing.testimonials.index');
    }
}