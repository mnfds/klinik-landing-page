<div>
    @if ($showModal)
        <div class="fixed inset-0 bg-charcoal/50 flex items-center justify-center z-50" x-data x-trap.noscroll="true">
            <div class="bg-white rounded-xl p-6 w-full max-w-lg">
                <h3 class="font-fraunces text-lg text-charcoal mb-4">Tambah Brosur</h3>

                <form wire:submit="save" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Judul</label>
                        <input type="text" wire:model="title"
                            class="w-full rounded-lg border-gray-300 focus:border-forest focus:ring-forest">
                        @error('title') <span class="text-blush text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">File Brosur (PDF)</label>
                        <input type="file" wire:model="file" accept="application/pdf"
                            class="w-full text-sm">
                        <div wire:loading wire:target="file" class="text-xs text-gray-400 mt-1">Mengunggah...</div>
                        @error('file') <span class="text-blush text-xs">{{ $message }}</span> @enderror
                    </div>

                    <label class="flex items-center gap-2">
                        <input type="checkbox" wire:model="is_active" class="rounded border-gray-300 text-forest">
                        <span class="text-sm text-charcoal">Jadikan brosur aktif sekarang</span>
                    </label>
                    @if ($is_active)
                        <p class="text-xs text-gold">Brosur aktif lain akan otomatis dinonaktifkan.</p>
                    @endif

                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" wire:click="close"
                            class="px-4 py-2 text-sm rounded-lg border border-charcoal/20">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 text-sm rounded-lg bg-forest text-ivory"
                            wire:loading.attr="disabled" wire:target="save">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>