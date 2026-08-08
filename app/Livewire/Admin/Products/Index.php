<?php

namespace App\Livewire\Admin\Products;

use App\Models\Products;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Kelola Produk')]
class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public ?int $deleteId = null;

    public function updatingSearch(): void
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
        $product = Products::findOrFail($this->deleteId);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        $this->deleteId = null;

        session()->flash('success', 'Produk berhasil dihapus.');
    }

    public function toggleActive(int $id): void
    {
        $product = Products::findOrFail($id);
        $product->update(['is_active' => ! $product->is_active]);
    }

    #[On('productSaved')]
    public function refreshList(): void
    {
        //
    }

    public function render()
    {
        $products = Products::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.admin.products.index', compact('products'));
    }
}