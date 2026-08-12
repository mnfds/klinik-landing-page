<?php

namespace App\Livewire\Admin\BannerHome;

use App\Models\BannerHome;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public bool $show = false;
    public ?int $bannerId = null;

    public string $text_badge = '';
    public string $text_title = '';
    public string $text_description = '';
    public $image_mobile;
    public ?string $existingImageMobile = null;
    public $image_desktop;
    public ?string $existingImageDesktop = null;
    public bool $is_active = true;

    protected function rules(): array
    {
        return [
            'text_badge' => 'nullable|string',
            'text_title' => 'nullable|string',
            'text_description' => 'nullable|string',
            'image_mobile' => 'nullable|image|max:2048',
            'image_desktop' => 'nullable|image|max:4096',
            'is_active' => 'boolean',
        ];
    }

    #[On('open-edit-banner-home-modal')]
    public function openModal(int $id): void
    {
        $banner = BannerHome::findOrFail($id);

        $this->bannerId = $banner->id;
        $this->text_badge = (string) $banner->text_badge;
        $this->text_title = (string) $banner->text_title;
        $this->text_description = (string) $banner->text_description;
        $this->existingImageMobile = $banner->image_mobile;
        $this->image_mobile = null;
        $this->existingImageDesktop = $banner->image_desktop;
        $this->image_desktop = null;
        $this->is_active = $banner->is_active;

        $this->resetErrorBag();
        $this->resetValidation();
        $this->show = true;
    }

    public function closeModal(): void
    {
        $this->show = false;
        $this->reset([
            'bannerId', 'text_badge', 'text_title', 'text_description',
            'image_mobile', 'existingImageMobile', 'image_desktop', 'existingImageDesktop',
        ]);
        $this->is_active = true;
    }

    public function save(): void
    {
        $validated = $this->validate();
        try {
            $banner = BannerHome::findOrFail($this->bannerId);
    
            if ($this->image_mobile) {
                if ($banner->image_mobile) {
                    Storage::disk('public')->delete($banner->image_mobile);
                }
                $validated['image_mobile'] = $this->image_mobile->store('banner-home', 'public');
            } else {
                unset($validated['image_mobile']);
            }
    
            if ($this->image_desktop) {
                if ($banner->image_desktop) {
                    Storage::disk('public')->delete($banner->image_desktop);
                }
                $validated['image_desktop'] = $this->image_desktop->store('banner-home', 'public');
            } else {
                unset($validated['image_desktop']);
            }
    
            $banner->update($validated);
    
            $this->closeModal();
            $this->dispatch('bannerHomeSaved');
            $this->dispatch('toast', type: 'success', message: 'Banner berhasil diperbarui.');
        } catch (\Throwable $th) {
            $this->dispatch('toast', type: 'error', message: 'Gagal memperbarui banner. silahkan coba lagi');
        }
    }

    public function render()
    {
        return view('livewire.admin.banner-home.edit');
    }
}