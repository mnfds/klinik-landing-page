<?php

namespace App\Livewire\Admin\Promos;

use App\Models\Promos;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public bool $show = false;

    public string $name = '';
    public string $description = '';
    public $image;
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

    #[On('open-create-promo-modal')]
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
        $this->reset(['name', 'description', 'image', 'start_date', 'end_date', 'price']);
        $this->is_active = true;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function save(): void
    {
        $validated = $this->validate();

        if ($this->image) {
            $validated['image'] = $this->image->store('promos', 'public');
        } else {
            unset($validated['image']);
        }

        Promos::create($validated);

        $this->closeModal();
        $this->dispatch('promoSaved');
        session()->flash('success', 'Promo berhasil ditambahkan.');
    }

    public function render()
    {
        return view('livewire.admin.promos.create');
    }
}