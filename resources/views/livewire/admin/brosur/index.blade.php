<div>
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-7">
        <div>
            <h1 class="font-fraunces text-2xl text-forest">Kelola Brosur</h1>
            <p class="text-sm text-charcoal/60 mt-0.5">Kelola e-brosur klinik, hanya 1 brosur yang bisa aktif.</p>
        </div>
        <button
            type="button"
            wire:click="$dispatch('open-create-brosur')"
            class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-emerald-400 text-ivory rounded-xl text-sm font-medium shadow-sm hover:bg-emerald-600 hover:shadow-md active:scale-[0.98] transition-all"
            >
            <i class="fa-solid fa-circle-plus"></i>
            Tambah Brosur
        </button>
    </div>

    {{-- Stat ringkas --}}
    <div class="grid grid-cols-3 gap-3 mb-6">
        <div class="bg-white rounded-xl border border-blue-300 px-4 py-3 shadow-md">
            <p class="text-xs text-charcoal/50">Total Brosur</p>
            <p class="text-xl font-fraunces text-forest mt-0.5">{{ $totalBrosur }}</p>
        </div>
        <div class="bg-white rounded-xl border border-blue-300 px-4 py-3 shadow-md">
            <p class="text-xs text-charcoal/50">Brosur Aktif</p>
            <p class="text-xl font-fraunces text-forest mt-0.5">{{ $totalActive }}</p>
        </div>
        <div class="bg-white rounded-xl border border-blue-300 px-4 py-3 shadow-md">
            <p class="text-xs text-charcoal/50">Brosur Nonaktif</p>
            <p class="text-xl font-fraunces text-forest mt-0.5">{{ $totalInactive }}</p>
        </div>
    </div>

    {{-- Filter bar --}}
    <div class="flex flex-col sm:flex-row gap-3 mb-4">
        <div class="relative w-full sm:w-64">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none"></i>
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Cari judul brosur..."
                class="w-full py-2 pl-9 rounded-xl border border-blue-300 text-sm focus:border-forest focus:ring-forest focus:ring-1 shadow-md"
            >
        </div>
        <div class="flex gap-2">
            @foreach (['' => 'Semua', 'active' => 'Aktif', 'inactive' => 'Nonaktif'] as $value => $label)
                <button
                    type="button"
                    wire:click="$set('filterStatus', '{{ $value }}')"
                    class="px-3.5 py-2 border border-indigo-300 rounded-xl text-xs font-medium transition {{ $filterStatus === $value ? 'bg-indigo-600 text-ivory shadow-sm' : 'bg-white text-charcoal/60 hover:text-ivory hover:bg-indigo-500 shadow-sm' }}"
                >
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    {{-- ================= DESKTOP: Tabel ================= --}}
    <div class="hidden md:block bg-white p-2 rounded-2xl shadow-sm overflow-hidden relative" wire:loading.class="opacity-60 pointer-events-none" wire:target="search,filterStatus">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-ivory/70 text-charcoal/60 text-left uppercase text-[11px] tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5 font-semibold">Brosur</th>
                        <th class="px-5 py-3.5 font-semibold">File</th>
                        <th class="px-5 py-3.5 font-semibold">Status</th>
                        <th class="px-5 py-3.5 font-semibold">Dibuat</th>
                        <th class="px-5 py-3.5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($brosurs as $brosur)
                        <tr wire:key="brosur-{{ $brosur->id }}" class="hover:bg-ivory/40 transition-colors group">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="w-11 h-11 bg-gradient-to-br from-forest/10 to-gold/10 rounded-xl flex items-center justify-center text-forest/40 shrink-0">
                                        <i class="fa-solid fa-file-pdf text-lg"></i>
                                    </div>
                                    <span class="font-medium text-charcoal">{{ $brosur->title }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-3.5">
                                <a href="{{ Storage::url($brosur->file) }}" target="_blank"
                                    class="text-gold text-xs font-medium hover:underline">
                                    <i class="fa-solid fa-arrow-up-right-from-square mr-1"></i> Lihat File
                                </a>
                            </td>
                            <td class="px-5 py-3.5">
                                <button
                                    wire:click="toggleActive({{ $brosur->id }})"
                                    wire:confirm="@if($brosur->is_active) Nonaktifkan brosur ini? Nav e-brochure akan hilang jika tidak ada brosur aktif lain. @else Aktifkan brosur ini? Brosur aktif lain akan otomatis dinonaktifkan. @endif"
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium transition {{ $brosur->is_active ? 'bg-green-50 text-green-700 hover:bg-green-100' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}"
                                >
                                    <span class="w-1.5 h-1.5 rounded-full {{ $brosur->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                    {{ $brosur->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </td>
                            <td class="px-5 py-3.5 text-charcoal/70 tabular-nums text-xs">
                                {{ $brosur->created_at->format('d M Y') }}
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-end gap-1 opacity-70 group-hover:opacity-100 transition-opacity">
                                    <button
                                        wire:click="$dispatch('open-edit-brosur', { id: {{ $brosur->id }} })"
                                        class="p-1.5 rounded-lg text-gold hover:bg-gold/10 transition"
                                        title="Edit"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.12 2.12 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                        </svg>
                                    </button>
                                    <button
                                        wire:click="confirmDelete({{ $brosur->id }})"
                                        class="p-1.5 rounded-lg text-red-400 hover:bg-red-50 hover:text-red-500 transition"
                                        title="Hapus"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m3 0v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6h14z"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-16 text-center text-charcoal/50">
                                <div class="flex flex-col items-center gap-2.5">
                                    <div class="w-12 h-12 rounded-2xl bg-ivory flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-charcoal/25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <rect x="3" y="7" width="18" height="13" rx="2"/>
                                            <path d="M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm">Belum ada brosur.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= MOBILE: Card list ================= --}}
    <div class="md:hidden space-y-3" wire:loading.class="opacity-60 pointer-events-none" wire:target="search,filterStatus">
        @forelse ($brosurs as $brosur)
            <div wire:key="mobile-brosur-{{ $brosur->id }}" class="bg-white rounded-2xl p-4 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-14 h-14 bg-gradient-to-br from-forest/10 to-gold/10 rounded-xl flex items-center justify-center text-forest/40 shrink-0">
                        <i class="fa-solid fa-file-pdf text-xl"></i>
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2">
                            <p class="font-medium text-charcoal leading-snug">{{ $brosur->title }}</p>
                            <button
                                wire:click="toggleActive({{ $brosur->id }})"
                                wire:confirm="@if($brosur->is_active) Nonaktifkan brosur ini? @else Aktifkan brosur ini? Yang lain akan dinonaktifkan. @endif"
                                class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-medium shrink-0 {{ $brosur->is_active ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}"
                            >
                                <span class="w-1.5 h-1.5 rounded-full {{ $brosur->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                {{ $brosur->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </div>
                        <div class="flex items-center gap-2 mt-1.5">
                            <a href="{{ Storage::url($brosur->file) }}" target="_blank" class="text-gold text-xs font-medium hover:underline">
                                <i class="fa-solid fa-arrow-up-right-from-square mr-1"></i> Lihat File
                            </a>
                            <span class="text-xs text-charcoal/60 tabular-nums">
                                {{ $brosur->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex gap-2 mt-3.5 pt-3.5 border-t border-gray-50">
                    <button
                        wire:click="$dispatch('open-edit-brosur-modal', { id: {{ $brosur->id }} })"
                        class="flex-1 text-center text-xs font-medium text-gold bg-gold/5 rounded-lg py-2 hover:bg-gold/10 transition"
                    >
                        Edit
                    </button>
                    <button
                        wire:click="confirmDelete({{ $brosur->id }})"
                        class="flex-1 text-center text-xs font-medium text-red-500 bg-red-50 rounded-lg py-2 hover:bg-red-100 transition"
                    >
                        Hapus
                    </button>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl py-14 text-center text-charcoal/50 shadow-sm">
                <div class="flex flex-col items-center gap-2.5">
                    <div class="w-12 h-12 rounded-2xl bg-ivory flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-charcoal/25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="7" width="18" height="13" rx="2"/>
                            <path d="M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2"/>
                        </svg>
                    </div>
                    <p class="text-sm">Belum ada brosur.</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-5">
        {{ $brosurs->links() }}
    </div>

    {{-- Modal konfirmasi hapus --}}
    @if ($deleteId)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm px-4" wire:click.self="cancelDelete">
            <div class="bg-white rounded-2xl p-6 max-w-sm w-full shadow-2xl animate-[fadeIn_0.2s_ease]">
                <div class="w-11 h-11 rounded-full bg-red-50 flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m3 0v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6h14z"/>
                    </svg>
                </div>
                <h3 class="font-fraunces text-lg text-forest mb-1.5">Hapus Brosur?</h3>
                <p class="text-sm text-charcoal/60 mb-6">Tindakan ini tidak dapat dibatalkan.</p>
                <div class="flex justify-end gap-3">
                    <button wire:click="cancelDelete" class="px-4 py-2 text-sm rounded-xl border border-gray-200 hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button wire:click="delete" class="px-4 py-2 text-sm rounded-xl bg-red-500 text-ivory hover:bg-red-600 shadow-sm transition">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    @endif

    <livewire:admin.brosur.create />
    <livewire:admin.brosur.edit />
</div>