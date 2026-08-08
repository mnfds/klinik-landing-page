<div>
    @if ($show)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4" wire:click.self="closeModal">
            <div class="bg-white rounded-xl p-6 max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-fraunces text-lg text-forest">Tambah Dokter</h3>
                    <button wire:click="closeModal" class="text-charcoal/50 hover:text-charcoal text-xl leading-none">&times;</button>
                </div>

                <form wire:submit="save" class="space-y-5">
                    {{-- Data dasar dokter --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">Nama Dokter</label>
                            <input type="text" wire:model="name" class="w-full rounded-lg border-gray-300 focus:border-forest focus:ring-forest text-sm">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">Spesialisasi</label>
                            <input type="text" wire:model="specialization" class="w-full rounded-lg border-gray-300 focus:border-forest focus:ring-forest text-sm">
                            @error('specialization') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Bio</label>
                        <textarea wire:model="bio" rows="3" class="w-full rounded-lg border-gray-300 focus:border-forest focus:ring-forest text-sm"></textarea>
                        @error('bio') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Foto</label>
                        <input type="file" wire:model="photo" accept="image/*" class="w-full text-sm">
                        <div wire:loading wire:target="photo" class="text-xs text-charcoal/50 mt-1">Mengunggah...</div>
                        @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" class="w-20 h-20 object-cover rounded-full mt-2">
                        @endif
                        @error('photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <label class="flex items-center gap-2 text-sm text-charcoal">
                        <input type="checkbox" wire:model="is_active" class="rounded border-gray-300 text-forest focus:ring-forest">
                        Aktifkan dokter
                    </label>

                    <hr class="border-gray-100">

                    {{-- Jadwal praktik --}}
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <label class="block text-sm font-medium text-charcoal">Jadwal Praktik</label>
                            <button type="button" wire:click="addSchedule" class="text-xs text-gold hover:underline">
                                + Tambah Jadwal
                            </button>
                        </div>

                        <div class="space-y-3">
                            @forelse ($schedules as $index => $schedule)
                                <div wire:key="new-schedule-{{ $index }}" class="flex flex-col sm:flex-row gap-2 items-start sm:items-center p-3 bg-ivory rounded-lg">
                                    <div class="w-full sm:w-32">
                                        <select wire:model="schedules.{{ $index }}.day" class="w-full rounded-lg border-gray-300 text-xs focus:border-forest focus:ring-forest">
                                            <option value="">Pilih Hari</option>
                                            @foreach ($dayOptions as $value => $label)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @error("schedules.$index.day") <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="w-full sm:w-28">
                                        <input type="time" wire:model="schedules.{{ $index }}.start_time" class="w-full rounded-lg border-gray-300 text-xs focus:border-forest focus:ring-forest">
                                        @error("schedules.$index.start_time") <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    <span class="text-charcoal/40 text-xs hidden sm:block">s/d</span>

                                    <div class="w-full sm:w-28">
                                        <input type="time" wire:model="schedules.{{ $index }}.end_time" class="w-full rounded-lg border-gray-300 text-xs focus:border-forest focus:ring-forest">
                                        @error("schedules.$index.end_time") <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    <label class="flex items-center gap-1 text-xs text-charcoal whitespace-nowrap">
                                        <input type="checkbox" wire:model="schedules.{{ $index }}.is_active" class="rounded border-gray-300 text-forest focus:ring-forest">
                                        Aktif
                                    </label>

                                    <button type="button" wire:click="removeSchedule({{ $index }})" class="ml-auto text-red-500 hover:text-red-600 text-xs">
                                        Hapus
                                    </button>
                                </div>
                            @empty
                                <p class="text-xs text-charcoal/50">Belum ada jadwal ditambahkan.</p>
                            @endforelse
                        </div>
                    </div>

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