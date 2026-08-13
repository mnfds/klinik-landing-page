<?php

namespace App\Livewire\Admin\Brosur;

use App\Models\Brosurs;
use App\Livewire\Concerns\WithCustomPagination;
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
    use WithCustomPagination;

    public ?int $deletingId = null;

    #[On('brosur-saved')]
    #[On('brosur-updated')]
    public function refreshList()
    {
        // no-op, memicu re-render karena render() query ulang tiap request
    }

    public function activate(int $id)
    {
        DB::transaction(function () use ($id) {
            Brosurs::where('is_active', true)->update(['is_active' => false]);
            Brosurs::where('id', $id)->update(['is_active' => true]);
        });

        session()->flash('message', 'Brosur berhasil diaktifkan.');
    }

    public function deactivate(int $id)
    {
        Brosurs::where('id', $id)->update(['is_active' => false]);
        session()->flash('message', 'Brosur dinonaktifkan.');
    }

    public function confirmDelete(int $id)
    {
        $this->deletingId = $id;
    }

    public function delete()
    {
        if ($this->deletingId) {
            $brosur = Brosurs::find($this->deletingId);

            if ($brosur) {
                Storage::disk('public')->delete($brosur->file);
                $brosur->delete();
            }

            session()->flash('message', 'Brosur berhasil dihapus.');
        }

        $this->deletingId = null;
    }

    public function render()
    {
        return view('livewire.admin.brosur.index', [
            'brosurs' => Brosurs::latest()->paginate($this->perPage ?? 10),
        ]);
    }
}