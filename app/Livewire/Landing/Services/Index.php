<?php

namespace App\Livewire\Landing\Services;

use App\Models\BannerPage;
use App\Models\Services;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.landing')]
#[Title('Layanan')]
class Index extends Component
{
    public string $activeType = 'all';

    public function setType(string $type): void
    {
        $this->activeType = $type;
    }

    public function getFilteredServicesProperty(): Collection
    {
        return Services::query()
            ->where('is_active', true)
            ->when($this->activeType !== 'all', fn ($q) => $q->where('type', $this->activeType))
            ->orderBy('name')
            ->get();
    }

    public function getBannerProperty(): ?BannerPage
    {
        return BannerPage::query()
            ->where('type', 'services')
            ->where('is_active', true)
            ->first();
    }

    public function render()
    {
        return view('livewire.landing.services.index');
    }
}