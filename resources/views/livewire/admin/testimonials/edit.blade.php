<div>
    @if ($show)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4" wire:click.self="closeModal">
            <div class="bg-white rounded-xl p-6 max-w-lg w-full max-h-[90vh] overflow-hidden flex flex-col">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-fraunces text-lg text-forest">Edit Testimoni</h3>
                    <button wire:click="closeModal" class="text-charcoal/50 hover:text-red-500 text-xl leading-none">&times;</button>
                </div>
                <div class="overflow-y-auto p-6">
                    <form wire:submit="save" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">Nama</label>
                            <input type="text" wire:model="name" class="w-full rounded-lg border p-2 border-gray-300 focus:border-forest focus:ring-forest text-sm">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
    
                        @if ($currentItemsTestimonialsText)
                            <p class="text-xs text-charcoal/50 -mb-2">Saat ini: <span class="font-medium">{{ $currentItemsTestimonialsText }}</span> — pilih ulang di bawah untuk mengubahnya.</p>
                        @endif
    
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-charcoal mb-1">Kategori</label>
                                <select wire:model.live="category" class="w-full rounded-lg border p-2 border-gray-300 focus:border-forest focus:ring-forest text-sm">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($this->categoryLabels() as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
    
                            <div>
                                <label class="block text-sm font-medium text-charcoal mb-1">Item</label>
                                <select wire:model="selected_item" class="w-full rounded-lg border p-2 border-gray-300 focus:border-forest focus:ring-forest text-sm" @disabled(! $category)>
                                    <option value="">{{ $category ? 'Pilih Item' : 'Pilih kategori dulu' }}</option>
                                    @foreach ($this->itemOptions() as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('selected_item') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
    
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">Pesan Testimoni</label>
                            <textarea wire:model="message" rows="3" class="w-full rounded-lg border p-2 border-gray-300 focus:border-forest focus:ring-forest text-sm"></textarea>
                            @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
    
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">Rating</label>
                            <div class="flex gap-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <button
                                        type="button"
                                        wire:click="$set('rating', {{ $i }})"
                                        class="text-2xl {{ $i <= $rating ? 'text-gold' : 'text-gray-300' }}"
                                    >
                                        ★
                                    </button>
                                @endfor
                            </div>
                            @error('rating') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
    
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-charcoal mb-1">Foto (opsional)</label>
    
                                @if ($existingPhoto && ! $photo)
                                    <img src="{{ \Storage::url($existingPhoto) }}" class="w-16 h-16 object-cover rounded-lg mb-2">
                                @endif
    
                                <input type="file" wire:model="photo" accept="image/*" class="w-full text-sm">
                                <div wire:loading wire:target="photo" class="text-xs text-charcoal/50 mt-1">Mengunggah...</div>
                                @if ($photo)
                                    <img src="{{ $photo->temporaryUrl() }}" class="w-16 h-16 object-cover rounded-lg mt-2">
                                @endif
                                @error('photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
    
                            <div>
                                <label class="block text-sm font-medium text-charcoal mb-1">Avatar (opsional)</label>
    
                                @if ($existingAvatar && ! $avatar)
                                    <img src="{{ \Storage::url($existingAvatar) }}" class="w-16 h-16 object-cover rounded-full mb-2">
                                @endif
    
                                <input type="file" wire:model="avatar" accept="image/*" class="w-full text-sm">
                                <div wire:loading wire:target="avatar" class="text-xs text-charcoal/50 mt-1">Mengunggah...</div>
                                @if ($avatar)
                                    <img src="{{ $avatar->temporaryUrl() }}" class="w-16 h-16 object-cover rounded-full mt-2">
                                @endif
                                @error('avatar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
    
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">Link YouTube (opsional)</label>
                            <input type="text" wire:model="youtube_link" placeholder="https://youtube.com/..." class="w-full rounded-lg border p-2 border-gray-300 focus:border-forest focus:ring-forest text-sm">
                            @error('youtube_link') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
    
                        <label class="flex items-center gap-2 text-sm text-charcoal">
                            <input type="checkbox" wire:model="is_active" class="rounded border-gray-300 text-forest focus:ring-forest">
                            Tampilkan testimoni
                        </label>
    
                        <div class="flex justify-end gap-3 pt-2">
                            <button type="button" wire:click="closeModal" class="px-4 py-2 text-sm rounded-lg border border-gray-200">
                                Batal
                            </button>
                            <button type="submit" wire:loading.attr="disabled" wire:target="save" class="px-4 py-2 text-sm rounded-lg bg-forest text-ivory">
                                <span wire:loading.remove wire:target="save">Simpan Perubahan</span>
                                <span wire:loading wire:target="save">Menyimpan...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>