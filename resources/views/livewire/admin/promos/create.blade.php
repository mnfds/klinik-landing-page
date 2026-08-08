<div>
    @if ($show)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4" wire:click.self="closeModal">
            <div class="bg-white rounded-xl p-6 max-w-lg w-full max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-fraunces text-lg text-forest">Tambah Promo</h3>
                    <button wire:click="closeModal" class="text-charcoal/50 hover:text-charcoal text-xl leading-none">&times;</button>
                </div>

                <form wire:submit="save" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Judul Promo</label>
                        <input type="text" wire:model="name" class="w-full rounded-lg border-gray-300 focus:border-forest focus:ring-forest text-sm">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Deskripsi</label>
                        <textarea wire:model="description" rows="3" class="w-full rounded-lg border-gray-300 focus:border-forest focus:ring-forest text-sm"></textarea>
                        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">Tanggal Mulai</label>
                            <input type="date" wire:model="start_date" class="w-full rounded-lg border-gray-300 focus:border-forest focus:ring-forest text-sm">
                            @error('start_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">Tanggal Berakhir</label>
                            <input type="date" wire:model="end_date" class="w-full rounded-lg border-gray-300 focus:border-forest focus:ring-forest text-sm">
                            @error('end_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Harga Promo (Rp)</label>
                        <input type="number" step="0.01" wire:model="price" class="w-full rounded-lg border-gray-300 focus:border-forest focus:ring-forest text-sm">
                        @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Gambar</label>
                        <input type="file" wire:model="image" accept="image/*" class="w-full text-sm">
                        <div wire:loading wire:target="image" class="text-xs text-charcoal/50 mt-1">Mengunggah...</div>
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" class="w-20 h-20 object-cover rounded-lg mt-2">
                        @endif
                        @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <label class="flex items-center gap-2 text-sm text-charcoal">
                        <input type="checkbox" wire:model="is_active" class="rounded border-gray-300 text-forest focus:ring-forest">
                        Aktifkan promo
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
    @endif
</div>