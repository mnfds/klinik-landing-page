<?php

namespace App\Livewire\Admin\Promos;

use App\Models\Promos;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public bool $show = false;
    public ?int $promoId = null;

    public string $name = '';
    public string $description = '';
    public $image;
    public ?string $existingImage = null;
    public string $start_date = '';
    public string $end_date = '';
    public $price = '';
    public bool $is_active = true;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
        ];
    }

    protected function messages(): array
    {
        return [
            'end_date.after_or_equal' => 'Tanggal berakhir tidak boleh sebelum tanggal mulai.',
        ];
    }

    #[On('open-edit-promo-modal')]
    public function openModal(int $id): void
    {
        $promo = Promos::findOrFail($id);

        $this->promoId = $promo->id;
        $this->name = $promo->name;
        $this->description = (string) $promo->description;
        $this->existingImage = $promo->image;
        $this->image = null;
        $this->start_date = $promo->start_date?->format('Y-m-d') ?? '';
        $this->end_date = $promo->end_date?->format('Y-m-d') ?? '';
        $this->price = $promo->price;
        $this->is_active = $promo->is_active;

        $this->resetErrorBag();
        $this->resetValidation();
        $this->show = true;
    }

    public function closeModal(): void
    {
        $this->show = false;
        $this->reset(['promoId', 'name', 'description', 'image', 'existingImage', 'start_date', 'end_date', 'price']);
        $this->is_active = true;
    }

    public function save(): void
    {
        $validated = $this->validate();

        $promo = Promos::findOrFail($this->promoId);

        if ($this->image) {
            if ($promo->image) {
                Storage::disk('public')->delete($promo->image);
            }
            $validated['image'] = $this->image->store('promos', 'public');
        } else {
            unset($validated['image']);
        }

        $promo->update($validated);

        $this->closeModal();
        $this->dispatch('promoSaved');
        session()->flash('success', 'Promo berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.admin.promos.edit');
    }
}