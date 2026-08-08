<?php

namespace App\Livewire\Admin\Testimonials;

use App\Models\Products;
use App\Models\Promos;
use App\Models\Services;
use App\Models\Testimonials;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public bool $show = false;

    public string $name = '';
    public $photo;
    public $avatar;
    public string $youtube_link = '';
    public string $message = '';
    public int $rating = 5;

    // Select bertingkat untuk "Mengenai"
    public string $category = '';
    public string $selected_item = ''; // menyimpan ID sementara, bukan langsung teks

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

    /** Daftar item untuk dropdown kedua, berdasarkan kategori terpilih */
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

    #[On('open-create-testimonial-modal')]
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
        $this->reset(['name', 'photo', 'avatar', 'youtube_link', 'message', 'category', 'selected_item']);
        $this->rating = 5;
        $this->is_active = true;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function save(): void
    {
        $validated = $this->validate();

        // Resolve item terpilih menjadi teks nama/judul untuk disimpan ke kolom items_testimonials
        $config = $this->categoryMap[$this->category];
        $item = $config['model']::find($this->selected_item);

        if (! $item) {
            $this->addError('selected_item', 'Item yang dipilih tidak ditemukan.');
            return;
        }

        $validated['items_testimonials'] = $item->{$config['field']};
        unset($validated['category'], $validated['selected_item']);

        if ($this->photo) {
            $validated['photo'] = $this->photo->store('testimonials', 'public');
        } else {
            unset($validated['photo']);
        }

        if ($this->avatar) {
            $validated['avatar'] = $this->avatar->store('testimonials/avatars', 'public');
        } else {
            unset($validated['avatar']);
        }

        Testimonials::create($validated);

        $this->closeModal();
        $this->dispatch('testimonialSaved');
        session()->flash('success', 'Testimoni berhasil ditambahkan.');
    }

    public function render()
    {
        return view('livewire.admin.testimonials.create');
    }
}