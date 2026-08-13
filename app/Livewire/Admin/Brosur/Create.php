<?php

namespace App\Livewire\Admin\Brosur;

use App\Models\Brosurs;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public bool $showModal = false;
    public string $title = '';
    public $file;
    public bool $is_active = false;

    #[On('open-create-brosur')]
    public function open()
    {
        $this->reset(['title', 'file', 'is_active']);
        $this->showModal = true;
    }

    public function close()
    {
        $this->showModal = false;
        $this->reset(['title', 'file', 'is_active']);
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf|max:10240',
            'is_active' => 'boolean',
        ]);
        try {
            DB::transaction(function () {
                if ($this->is_active) {
                    Brosurs::where('is_active', true)->update(['is_active' => false]);
                }
    
                Brosurs::create([
                    'title' => $this->title,
                    'file' => $this->file->store('brosurs', 'public'),
                    'is_active' => $this->is_active,
                ]);
            });
    
            $this->close();
            $this->dispatch('brosur-saved');
            $this->dispatch('toast', type: 'success', message: 'Brosur berhasil disimpan.');
        } catch (\Throwable $th) {
            $this->dispatch('toast', type: 'error', message: 'Gagal menyimpan brosur. silahkan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.admin.brosur.create');
    }
}