<?php

namespace App\Livewire\Admin\BannerPage;

use App\Models\BannerPage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public bool $show = false;

    public string $type = '';
    public string $text_badge = '';
    public string $text_title = '';
    public string $text_description = '';
    public $image_mobile;
    public $image_desktop;
    public bool $is_active = true;

    public array $typeOptions = [
        'services' => 'Layanan',
        'products' => 'Produk',
        'promos' => 'Promo',
        'doctors' => 'Dokter',
        'testimonials' => 'Testimoni',
    ];

    protected function rules(): array
    {
        return [
            'type' => 'required|in:services,products,promos,doctors,testimonials|unique:banner_pages,type',
            'text_badge' => 'nullable|string',
            'text_title' => 'nullable|string',
            'text_description' => 'nullable|string',
            'image_mobile' => 'nullable|image|max:2048',
            'image_desktop' => 'nullable|image|max:4096',
            'is_active' => 'boolean',
        ];
    }

    protected function messages(): array
    {
        return [
            'type.required' => 'Halaman wajib dipilih.',
            'type.unique' => 'Banner untuk halaman ini sudah ada. Silakan edit banner yang sudah ada.',
        ];
    }

    #[On('open-create-banner-page-modal')]
    public function openModal(): void
    {
        $this->resetForm();
        $this->show = true;
    }

    public function closeModal(): void
    {
        $this->show = false;
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->reset(['type', 'text_badge', 'text_title', 'text_description', 'image_mobile', 'image_desktop']);
        $this->is_active = true;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function save(): void
    {
        $validated = $this->validate();
        try {
            if ($this->image_mobile) {
                $validated['image_mobile'] = $this->image_mobile->store('banner-page', 'public');
            } else {
                unset($validated['image_mobile']);
            }
    
            if ($this->image_desktop) {
                $validated['image_desktop'] = $this->image_desktop->store('banner-page', 'public');
            } else {
                unset($validated['image_desktop']);
            }
    
            BannerPage::create($validated);
    
            $this->closeModal();
            $this->dispatch('bannerPageSaved');
            $this->dispatch('toast', type: 'success', message: 'Banner berhasil disimpan.');
        } catch (\Throwable $th) {
            $this->dispatch('toast', type: 'error', message: 'Gagal menyimpan banner. silahkan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.admin.banner-page.create');
    }
}