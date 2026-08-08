<?php

namespace App\Livewire\Admin\Services;

use App\Models\Services;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public bool $show = false;

    public string $name = '';
    public string $type = 'treatment';
    public string $description = '';
    public $price = '';
    public $image;
    public string $youtube_link = '';
    public bool $is_active = true;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|in:treatment,medical',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'youtube_link' => 'nullable|url|max:255',
            'is_active' => 'boolean',
        ];
    }

    #[On('open-create-service-modal')]
    public function openModal(): void
    {
        $this->resetForm();
        $this->show = true;
    }

    public function closeModal(): void
    {
        $this->show = false;
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->reset(['name', 'description', 'price', 'image', 'youtube_link']);
        $this->type = 'treatment';
        $this->is_active = true;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function save(): void
    {
        $validated = $this->validate();

        if ($this->image) {
            $validated['image'] = $this->image->store('services', 'public');
        } else {
            unset($validated['image']);
        }

        Services::create($validated);

        $this->closeModal();
        $this->dispatch('serviceSaved');
        session()->flash('success', 'Layanan berhasil ditambahkan.');
    }

    public function render()
    {
        return view('livewire.admin.services.create');
    }
}
