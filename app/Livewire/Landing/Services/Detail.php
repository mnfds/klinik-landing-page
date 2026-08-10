<?php

namespace App\Livewire\Landing\Services;

use App\Models\Services;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.landing')]
#[Title('Detail Layanan')]
class Detail extends Component
{
    public Services $service;

    public function mount(Services $service): void
    {
        abort_unless($service->is_active, 404);

        $this->service = $service;
    }

    public function render()
    {
        return view('livewire.landing.services.detail');
    }
}