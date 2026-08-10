<?php

namespace App\Livewire\Admin\BannerPage;

use App\Models\BannerPage;
use Illuminate\Support\Facades\Storage;
use App\Livewire\Concerns\WithCustomPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Kelola Banner Page')]
class Index extends Component
{
    use WithPagination, WithCustomPagination;

    public string $filterType = '';
    public ?int $deleteId = null;

    public array $typeLabels = [
        'services' => 'Layanan',
        'products' => 'Produk',
        'promos' => 'Promo',
        'doctors' => 'Dokter',
        'testimonials' => 'Testimoni',
    ];

    public function updatingFilterType(): void
    {
        $this->resetPage();
    }

    public function confirmDelete(int $id): void
    {
        $this->deleteId = $id;
    }

    public function cancelDelete(): void
    {
        $this->deleteId = null;
    }

    public function delete(): void
    {
        $banner = BannerPage::findOrFail($this->deleteId);

        if ($banner->image_mobile) {
            Storage::disk('public')->delete($banner->image_mobile);
        }
        if ($banner->image_desktop) {
            Storage::disk('public')->delete($banner->image_desktop);
        }

        $banner->delete();
        $this->deleteId = null;

        session()->flash('success', 'Banner page berhasil dihapus.');
    }

    public function toggleActive(int $id): void
    {
        $banner = BannerPage::findOrFail($id);
        $banner->update(['is_active' => ! $banner->is_active]);
    }

    #[On('bannerPageSaved')]
    public function refreshList(): void
    {
        //
    }

    public function render()
    {
        $banners = BannerPage::query()
            ->when($this->filterType, fn ($q) => $q->where('type', $this->filterType))
            ->orderBy('type')
            ->paginate(10);

        return view('livewire.admin.banner-page.index', [
            'banners' => $banners,
            'totalBanners' => BannerPage::count(),
            'totalActive' => BannerPage::where('is_active', true)->count(),
            'totalInactive' => BannerPage::where('is_active', false)->count(),
        ]);
    }
}