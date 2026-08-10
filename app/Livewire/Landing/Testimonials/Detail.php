<?php

namespace App\Livewire\Landing\Testimonials;

use App\Models\Testimonials as TestimonialsModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.landing')]
#[Title('Detail Testimoni')]
class Detail extends Component
{
    public TestimonialsModel $testimonial;

    public function mount(TestimonialsModel $testimonial): void
    {
        abort_unless($testimonial->is_active, 404);

        $this->testimonial = $testimonial;
    }

    public function render()
    {
        return view('livewire.landing.testimonials.detail');
    }
}