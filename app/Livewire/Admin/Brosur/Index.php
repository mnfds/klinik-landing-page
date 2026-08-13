<?php

namespace App\Livewire\Admin\Brosur;

use App\Models\Brosurs;
use App\Livewire\Concerns\WithCustomPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Kelola Brosur')]
class Index extends Component
{
    use WithPagination, WithCustomPagination;

    public string $search = '';
    public string $filterStatus = ''; // '', 'active', 'inactive'
    public ?int $deleteId = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    #[On('brosur-saved')]
    #[On('brosur-updated')]
    public function refreshList()
    {
        // no-op, render() query ulang tiap request
    }

    public function toggleActive(int $id)
    {
        $brosur = Brosurs::findOrFail($id);

        if ($brosur->is_active) {
            // sedang aktif -> nonaktifkan
            $brosur->update(['is_active' => false]);
            session()->flash('message', 'Brosur dinonaktifkan.');
        } else {
            // sedang nonaktif -> aktifkan, otomatis nonaktifkan yang lain
            DB::transaction(function () use ($brosur) {
                Brosurs::where('is_active', true)->update(['is_active' => false]);
                $brosur->update(['is_active' => true]);
            });
            session()->flash('message', 'Brosur berhasil diaktifkan.');
        }
    }

    public function confirmDelete(int $id)
    {
        $this->deleteId = $id;
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
    }

    public function delete()
    {
        try {
            if ($this->deleteId) {
                $brosur = Brosurs::find($this->deleteId);
    
                if ($brosur) {
                    Storage::disk('public')->delete($brosur->file);
                    $brosur->delete();
                }
    
                session()->flash('message', 'Brosur berhasil dihapus.');
            }
            $this->deleteId = null;
            $this->dispatch('toast', type: 'success', message: 'Brosur berhasil dihapus.');
        } catch (\Throwable $th) {
            $this->dispatch('toast', type: 'error', message: 'Gagal menghapus brosur. silahkan coba lagi.');
        }
    }

    public function render()
    {
        $query = Brosurs::query()
            ->when($this->search, fn ($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->when($this->filterStatus === 'active', fn ($q) => $q->where('is_active', true))
            ->when($this->filterStatus === 'inactive', fn ($q) => $q->where('is_active', false))
            ->latest();

        return view('livewire.admin.brosur.index', [
            'brosurs' => $query->paginate($this->perPage ?? 10),
            'totalBrosur' => Brosurs::count(),
            'totalActive' => Brosurs::where('is_active', true)->count(),
            'totalInactive' => Brosurs::where('is_active', false)->count(),
        ]);
    }
}