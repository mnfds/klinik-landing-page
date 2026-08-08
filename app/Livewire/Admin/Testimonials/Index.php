<?php

namespace App\Livewire\Admin\Testimonials;

use App\Models\Testimonials;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Kelola Testimoni')]
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
        $testimonial = Testimonials::findOrFail($this->deleteId);

        if ($testimonial->photo) {
            Storage::disk('public')->delete($testimonial->photo);
        }
        if ($testimonial->avatar) {
            Storage::disk('public')->delete($testimonial->avatar);
        }

        $testimonial->delete();
        $this->deleteId = null;

        session()->flash('success', 'Testimoni berhasil dihapus.');
    }

    public function toggleActive(int $id): void
    {
        $testimonial = Testimonials::findOrFail($id);
        $testimonial->update(['is_active' => ! $testimonial->is_active]);
    }

    #[On('testimonialSaved')]
    public function refreshList(): void
    {
        //
    }

    public function render()
    {
        $testimonials = Testimonials::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('livewire.admin.testimonials.index', compact('testimonials'));
    }
}