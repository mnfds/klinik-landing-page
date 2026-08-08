<?php

namespace App\Livewire\Admin\Services;

use App\Models\Services;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public bool $show = false;
    public ?int $serviceId = null;

    public string $name = '';
    public string $type = 'treatment';
    public string $description = '';
    public $price = '';
    public $image;
    public ?string $existingImage = null;
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

    #[On('open-edit-service-modal')]
    public function openModal(int $id): void
    {
        $service = Services::findOrFail($id);

        $this->serviceId = $service->id;
        $this->name = $service->name;
        $this->type = $service->type;
        $this->description = (string) $service->description;
        $this->price = $service->price;
        $this->existingImage = $service->image;
        $this->image = null;
        $this->youtube_link = (string) $service->youtube_link;
        $this->is_active = $service->is_active;

        $this->resetErrorBag();
        $this->resetValidation();
        $this->show = true;
    }

    public function closeModal(): void
    {
        $this->show = false;
        $this->reset(['serviceId', 'name', 'description', 'price', 'image', 'existingImage', 'youtube_link']);
        $this->type = 'treatment';
        $this->is_active = true;
    }

    public function save(): void
    {
        $validated = $this->validate();

        $service = Services::findOrFail($this->serviceId);

        if ($this->image) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $this->image->store('services', 'public');
        } else {
            unset($validated['image']);
        }

        $service->update($validated);

        $this->closeModal();
        $this->dispatch('serviceSaved');
        session()->flash('success', 'Layanan berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.admin.services.edit');
    }
}