<div>
    @if ($show)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4" wire:click.self="closeModal">
            <div class="bg-white rounded-xl p-6 max-w-lg w-full max-h-[90vh] overflow-hidden flex flex-col">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-fraunces text-lg text-forest">Tambah Banner Page</h3>
                    <button wire:click="closeModal" class="text-charcoal/50 hover:text-red-500 text-xl leading-none">&times;</button>
                </div>
                <div class="overflow-y-auto p-6">
                    <form wire:submit="save" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">Halaman</label>
                            <select wire:model="type" class="w-full rounded-lg border p-2 border-gray-300 focus:border-forest focus:ring-forest text-sm">
                                <option value="">Pilih Halaman</option>
                                @foreach ($typeOptions as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
    
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">Badge</label>
                            <input type="text" wire:model="text_badge" class="w-full rounded-lg border p-2 border-gray-300 focus:border-forest focus:ring-forest text-sm">
                            @error('text_badge') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
    
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">Judul</label>
                            <textarea wire:model="text_title" rows="2" class="w-full rounded-lg border p-2 border-gray-300 focus:border-forest focus:ring-forest text-sm"></textarea>
                            @error('text_title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
    
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">Deskripsi</label>
                            <textarea wire:model="text_description" rows="3" class="w-full rounded-lg border p-2 border-gray-300 focus:border-forest focus:ring-forest text-sm"></textarea>
                            @error('text_description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
    
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">Gambar Mobile</label>
                            <input type="file" wire:model="image_mobile" accept="image/*" class="w-full text-sm">
                            <div wire:loading wire:target="image_mobile" class="text-xs text-charcoal/50 mt-1">Mengunggah...</div>
                            @if ($image_mobile)
                                <img src="{{ $image_mobile->temporaryUrl() }}" class="w-24 h-16 object-cover rounded-lg mt-2">
                            @endif
                            @error('image_mobile') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            <span class="text-xs text-gray-300">(Max 10 mb)</span>
                        </div>
    
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">Gambar Desktop</label>
                            <input type="file" wire:model="image_desktop" accept="image/*" class="w-full text-sm">
                            <div wire:loading wire:target="image_desktop" class="text-xs text-charcoal/50 mt-1">Mengunggah...</div>
                            @if ($image_desktop)
                                <img src="{{ $image_desktop->temporaryUrl() }}" class="w-32 h-16 object-cover rounded-lg mt-2">
                            @endif
                            @error('image_desktop') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            <span class="text-xs text-gray-300">(Max 10 mb)</span>
                        </div>
    
                        <label class="flex items-center gap-2 text-sm text-charcoal">
                            <input type="checkbox" wire:model="is_active" class="rounded border-gray-300 text-forest focus:ring-forest">
                            Aktifkan banner
                        </label>
    
                        <div class="flex justify-end gap-3 pt-2">
                            <button type="button" wire:click="closeModal" class="px-4 py-2 text-sm rounded-lg border border-gray-200">
                                Batal
                            </button>
                            <button type="submit" wire:loading.attr="disabled" wire:target="save" class="px-4 py-2 text-sm rounded-lg bg-forest text-ivory">
                                <span wire:loading.remove wire:target="save">Simpan</span>
                                <span wire:loading wire:target="save">Menyimpan...</span>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    @endif
</div>