<?php

namespace App\Livewire\Admin\Brosur;

use App\Models\Brosurs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public bool $showModal = false;
    public ?int $brosurId = null;
    public string $title = '';
    public $file; // file baru (opsional)
    public ?string $currentFile = null;
    public bool $is_active = false;

    #[On('open-edit-brosur')]
    public function open(int $id)
    {
        $brosur = Brosurs::findOrFail($id);

        $this->brosurId = $brosur->id;
        $this->title = $brosur->title;
        $this->currentFile = $brosur->file;
        $this->is_active = $brosur->is_active;
        $this->file = null;

        $this->showModal = true;
    }

    public function close()
    {
        $this->showModal = false;
        $this->reset(['brosurId', 'title', 'file', 'currentFile', 'is_active']);
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf|max:10240',
            'is_active' => 'boolean',
        ]);
        try {
            DB::transaction(function () {
                $brosur = Brosurs::findOrFail($this->brosurId);
                if ($this->is_active) {
                    Brosurs::where('is_active', true)
                        ->where('id', '!=', $this->brosurId)
                        ->update(['is_active' => false]);
                }
                $data = [
                    'title' => $this->title,
                    'is_active' => $this->is_active,
                ];
    
                if ($this->file) {
                    Storage::disk('public')->delete($brosur->file);
                    $data['file'] = $this->file->store('brosurs', 'public');
                }
                $brosur->update($data);
            });
    
            $this->close();
            $this->dispatch('brosur-updated');
            $this->dispatch('toast', type: 'success', message: 'Brosur berhasil diperbarui.');
        } catch (\Throwable $th) {
            $this->dispatch('toast', type: 'error', message: 'Gagal memperbarui brosur. Silahkan coba lagi');
        }

    }

    public function render()
    {
        return view('livewire.admin.brosur.edit');
    }
}