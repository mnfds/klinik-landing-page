<?php

namespace App\Livewire\Admin\Products;

use App\Models\Products;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public bool $show = false;

    public string $name = '';
    public string $description = '';
    public $price = '';
    public $image;
    public bool $is_active = true;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ];
    }

    #[On('open-create-product-modal')]
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
        $this->reset(['name', 'description', 'price', 'image']);
        $this->is_active = true;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function save(): void
    {
        $validated = $this->validate();

        if ($this->image) {
            $validated['image'] = $this->image->store('products', 'public');
        } else {
            unset($validated['image']);
        }

        Products::create($validated);

        $this->closeModal();
        $this->dispatch('productSaved');
        session()->flash('success', 'Produk berhasil ditambahkan.');
    }

    public function render()
    {
        return view('livewire.admin.products.create');
    }
}