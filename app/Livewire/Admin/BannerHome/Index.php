<?php

namespace App\Livewire\Admin\BannerHome;

use App\Models\BannerHome;
use Illuminate\Support\Facades\Storage;
use App\Livewire\Concerns\WithCustomPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Kelola Banner Home')]
class Index extends Component
{
    use WithPagination, WithCustomPagination;

    public ?int $deleteId = null;

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
        $banner = BannerHome::findOrFail($this->deleteId);

        if ($banner->image_mobile) {
            Storage::disk('public')->delete($banner->image_mobile);
        }
        if ($banner->image_desktop) {
            Storage::disk('public')->delete($banner->image_desktop);
        }

        $banner->delete();
        $this->deleteId = null;

        session()->flash('success', 'Banner home berhasil dihapus.');
    }

    public function toggleActive(int $id): void
    {
        $banner = BannerHome::findOrFail($id);
        $banner->update(['is_active' => ! $banner->is_active]);
    }

    #[On('bannerHomeSaved')]
    public function refreshList(): void
    {
        //
    }

    public function render()
    {
        $banners = BannerHome::query()
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('livewire.admin.banner-home.index', [
            'banners' => $banners,
            'totalBanners' => BannerHome::count(),
            'totalActive' => BannerHome::where('is_active', true)->count(),
            'totalInactive' => BannerHome::where('is_active', false)->count(),
        ]);;
    }
}