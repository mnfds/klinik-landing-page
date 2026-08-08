<?php

namespace App\Livewire\Admin\Doctors;

use App\Models\Doctors;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Kelola Dokter')]
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
        $doctor = Doctors::findOrFail($this->deleteId);

        if ($doctor->photo) {
            Storage::disk('public')->delete($doctor->photo);
        }

        // schedules ikut terhapus otomatis (cascadeOnDelete di migration)
        $doctor->delete();
        $this->deleteId = null;

        session()->flash('success', 'Dokter berhasil dihapus.');
    }

    public function toggleActive(int $id): void
    {
        $doctor = Doctors::findOrFail($id);
        $doctor->update(['is_active' => ! $doctor->is_active]);
    }

    #[On('doctorSaved')]
    public function refreshList(): void
    {
        //
    }

    public function render()
    {
        $doctors = Doctors::query()
            ->withCount('schedules')
            ->when($this->search, fn ($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.admin.doctors.index', compact('doctors'));
    }
}