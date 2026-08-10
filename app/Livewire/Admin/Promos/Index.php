<?php

namespace App\Livewire\Admin\Promos;

use App\Models\Promos;
use Illuminate\Support\Facades\Storage;
use App\Livewire\Concerns\WithCustomPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Kelola Promo')]
class Index extends Component
{
    use WithPagination, WithCustomPagination;

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
        $promo = Promos::findOrFail($this->deleteId);

        if ($promo->image) {
            Storage::disk('public')->delete($promo->image);
        }

        $promo->delete();
        $this->deleteId = null;

        session()->flash('success', 'Promo berhasil dihapus.');
    }

    public function toggleActive(int $id): void
    {
        $promo = Promos::findOrFail($id);
        $promo->update(['is_active' => ! $promo->is_active]);
    }

    #[On('promoSaved')]
    public function refreshList(): void
    {
        //
    }

    public function render()
    {
        $promos = Promos::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->orderByDesc('start_date')
            ->paginate(10);

        return view('livewire.admin.promos.index', [
            'promos' => $promos,
            'totalPromos' => Promos::count(),
            'totalActive' => Promos::where('is_active', true)->count(),
            'totalInactive' => Promos::where('is_active', false)->count(),
            'activePromos' => Promos::where('is_active', true)
                ->whereNotNull('end_date')
                ->whereDate('start_date', '<=', today())
                ->whereDate('end_date', '>=', today())
                ->count(),
            'upcomingPromos' => Promos::where('is_active', true)
                ->whereNotNull('end_date')
                ->whereDate('start_date', '>', today())
                ->count(),
            'expiredPromos' => Promos::whereNotNull('end_date')
            ->whereDate('end_date', '<', today())
            ->count(),
        ]);
    }
}