<?php

namespace App\Livewire\Admin\Products;

use App\Models\Products;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public bool $show = false;
    public ?int $productId = null;

    public string $name = '';
    public string $description = '';
    public $price = '';
    public $image;
    public ?string $existingImage = null;
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

    #[On('open-edit-product-modal')]
    public function openModal(int $id): void
    {
        $product = Products::findOrFail($id);

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->description = (string) $product->description;
        $this->price = $product->price;
        $this->existingImage = $product->image;
        $this->image = null;
        $this->is_active = $product->is_active;

        $this->resetErrorBag();
        $this->resetValidation();
        $this->show = true;
    }

    public function closeModal(): void
    {
        $this->show = false;
        $this->reset(['productId', 'name', 'description', 'price', 'image', 'existingImage']);
        $this->is_active = true;
    }

    public function save(): void
    {
        $validated = $this->validate();

        $product = Products::findOrFail($this->productId);

        if ($this->image) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $this->image->store('products', 'public');
        } else {
            unset($validated['image']);
        }

        $product->update($validated);

        $this->closeModal();
        $this->dispatch('productSaved');
        session()->flash('success', 'Produk berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.admin.products.edit');
    }
}