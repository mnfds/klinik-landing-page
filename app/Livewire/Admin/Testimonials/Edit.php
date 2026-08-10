<?php

namespace App\Livewire\Admin\Testimonials;

use App\Models\Products;
use App\Models\Promos;
use App\Models\Services;
use App\Models\Testimonials;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public bool $show = false;
    public ?int $testimonialId = null;

    public string $name = '';
    public $photo;
    public ?string $existingPhoto = null;
    public $avatar;
    public ?string $existingAvatar = null;
    public string $youtube_link = '';
    public string $message = '';
    public int $rating = 5;

    public string $category = '';
    public string $selected_item = '';
    public string $currentItemsTestimonialsText = ''; // nilai lama, ditampilkan sebagai referensi

    public bool $is_active = true;

    protected array $categoryMap = [
        'services' => ['model' => Services::class, 'label' => 'Layanan', 'field' => 'name'],
        'products' => ['model' => Products::class, 'label' => 'Produk', 'field' => 'name'],
        'promos' => ['model' => Promos::class, 'label' => 'Promo', 'field' => 'name'],
    ];

    public function categoryLabels(): array
    {
        return collect($this->categoryMap)->map(fn ($c) => $c['label'])->toArray();
    }

    public function itemOptions(): Collection
    {
        if (! $this->category || ! isset($this->categoryMap[$this->category])) {
            return collect();
        }

        $config = $this->categoryMap[$this->category];
        $model = $config['model'];
        $field = $config['field'];

        return $model::query()
            ->where('is_active', true)
            ->orderBy($field)
            ->get(['id', $field])
            ->map(fn ($item) => ['id' => $item->id, 'name' => $item->{$field}]);
    }

    public function updatedCategory(): void
    {
        $this->selected_item = '';
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'avatar' => 'nullable|image|max:1024',
            'youtube_link' => 'nullable|url|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'category' => 'required|in:' . implode(',', array_keys($this->categoryMap)),
            'selected_item' => 'required',
            'is_active' => 'boolean',
        ];
    }

    protected function messages(): array
    {
        return [
            'category.required' => 'Kategori wajib dipilih.',
            'selected_item.required' => 'Item wajib dipilih.',
        ];
    }

    #[On('open-edit-testimonial-modal')]
    public function openModal(int $id): void
    {
        $testimonial = Testimonials::findOrFail($id);

        $this->testimonialId = $testimonial->id;
        $this->name = $testimonial->name;
        $this->existingPhoto = $testimonial->photo;
        $this->photo = null;
        $this->existingAvatar = $testimonial->avatar;
        $this->avatar = null;
        $this->youtube_link = (string) $testimonial->youtube_link;
        $this->message = $testimonial->message;
        $this->rating = $testimonial->rating;
        $this->is_active = $testimonial->is_active;

        $this->currentItemsTestimonialsText = $testimonial->items_testimonials;

        // Auto-detect kategori & item berdasarkan teks yang tersimpan
        $this->autoDetectCategoryAndItem($testimonial->items_testimonials);

        $this->resetErrorBag();
        $this->resetValidation();
        $this->show = true;
    }

    private function autoDetectCategoryAndItem(string $itemText): void
    {
        $this->category = '';
        $this->selected_item = '';

        foreach ($this->categoryMap as $key => $config) {
            $model = $config['model'];
            $field = $config['field'];

            $match = $model::query()->where($field, $itemText)->first();

            if ($match) {
                $this->category = $key;
                $this->selected_item = (string) $match->id;
                return;
            }
        }
    }

    public function closeModal(): void
    {
        $this->show = false;
        $this->reset([
            'testimonialId', 'name', 'photo', 'existingPhoto', 'avatar', 'existingAvatar',
            'youtube_link', 'message', 'category', 'selected_item', 'currentItemsTestimonialsText',
        ]);
        $this->rating = 5;
        $this->is_active = true;
    }

    public function save(): void
    {
        $validated = $this->validate();

        $config = $this->categoryMap[$this->category];
        $item = $config['model']::find($this->selected_item);

        if (! $item) {
            $this->addError('selected_item', 'Item yang dipilih tidak ditemukan.');
            return;
        }

        $validated['items_testimonials'] = $item->{$config['field']};
        unset($validated['category'], $validated['selected_item']);

        $testimonial = Testimonials::findOrFail($this->testimonialId);

        if ($this->photo) {
            if ($testimonial->photo) {
                Storage::disk('public')->delete($testimonial->photo);
            }
            $validated['photo'] = $this->photo->store('testimonials', 'public');
        } else {
            unset($validated['photo']);
        }

        if ($this->avatar) {
            if ($testimonial->avatar) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
            $validated['avatar'] = $this->avatar->store('testimonials/avatars', 'public');
        } else {
            unset($validated['avatar']);
        }

        $testimonial->update($validated);

        $this->closeModal();
        $this->dispatch('testimonialSaved');
        session()->flash('success', 'Testimoni berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.admin.testimonials.edit');
    }
}