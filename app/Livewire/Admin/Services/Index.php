<?php

namespace App\Livewire\Admin\Services;

use App\Livewire\Concerns\WithCustomPagination;
use App\Models\Services;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Kelola Layanan')]
class Index extends Component
{
    use WithPagination, WithCustomPagination;

    public string $search = '';
    public string $filterType = '';
    public ?int $deleteId = null;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

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
        $service = Services::findOrFail($this->deleteId);

        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();
        $this->deleteId = null;

        session()->flash('success', 'Layanan berhasil dihapus.');
    }

    public function toggleActive(int $id): void
    {
        $service = Services::findOrFail($id);
        $service->update(['is_active' => ! $service->is_active]);
    }

    #[On('serviceSaved')]
    public function refreshList(): void
    {
        // trigger re-render, memuat ulang query
    }

    public function render()
    {
        $services = Services::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->filterType, fn ($q) => $q->where('type', $this->filterType))
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.admin.services.index', compact('services'));
    }
}