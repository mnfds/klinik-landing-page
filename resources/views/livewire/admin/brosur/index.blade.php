<div>
    <div class="flex items-center justify-between mb-6">
        <h1 class="font-fraunces text-2xl text-charcoal">Kelola Brosur</h1>
        <button wire:click="$dispatch('open-create-brosur')"
            class="bg-forest text-ivory px-4 py-2 rounded-lg hover:bg-forest/90 transition">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Brosur
        </button>
    </div>

    @if (session('message'))
        <div class="bg-forest/10 text-forest px-4 py-3 rounded-lg mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-ivory text-charcoal text-sm uppercase">
                <tr>
                    <th class="px-4 py-3">Judul</th>
                    <th class="px-4 py-3">File</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Dibuat</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($brosurs as $brosur)
                    <tr wire:key="brosur-{{ $brosur->id }}">
                        <td class="px-4 py-3 font-medium text-charcoal">{{ $brosur->title }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ Storage::url($brosur->file) }}" target="_blank"
                                class="text-gold hover:underline">
                                <i class="fa-solid fa-file-pdf mr-1"></i> Lihat File
                            </a>
                        </td>
                        <td class="px-4 py-3">
                            @if ($brosur->is_active)
                                <span class="bg-forest/10 text-forest px-2 py-1 rounded-full text-xs font-medium">
                                    Aktif
                                </span>
                            @else
                                <span class="bg-gray-100 text-gray-500 px-2 py-1 rounded-full text-xs font-medium">
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            {{ $brosur->created_at->format('d M Y') }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex justify-end gap-2">
                                @if ($brosur->is_active)
                                    <button wire:click="deactivate({{ $brosur->id }})"
                                        wire:confirm="Nonaktifkan brosur ini? Nav e-brochure akan hilang jika tidak ada brosur aktif lain."
                                        class="px-3 py-1.5 text-xs rounded-lg border border-charcoal/20 text-charcoal hover:bg-charcoal/5">
                                        Nonaktifkan
                                    </button>
                                @else
                                    <button wire:click="activate({{ $brosur->id }})"
                                        class="px-3 py-1.5 text-xs rounded-lg bg-forest text-ivory hover:bg-forest/90">
                                        Aktifkan
                                    </button>
                                @endif

                                <button wire:click="$dispatch('open-edit-brosur', { id: {{ $brosur->id }} })"
                                    class="px-3 py-1.5 text-xs rounded-lg border border-gold text-gold hover:bg-gold/10">
                                    Edit
                                </button>

                                <button wire:click="confirmDelete({{ $brosur->id }})"
                                    class="px-3 py-1.5 text-xs rounded-lg border border-blush text-blush hover:bg-blush/10">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-400">
                            Belum ada brosur. Klik "Tambah Brosur" untuk membuat.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $brosurs->links() }}
    </div>

    {{-- Modal konfirmasi hapus --}}
    @if ($deletingId)
        <div class="fixed inset-0 bg-charcoal/50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl p-6 w-full max-w-sm">
                <h3 class="font-fraunces text-lg text-charcoal mb-2">Hapus Brosur?</h3>
                <p class="text-sm text-gray-500 mb-4">Tindakan ini tidak bisa dibatalkan.</p>
                <div class="flex justify-end gap-2">
                    <button wire:click="$set('deletingId', null)"
                        class="px-4 py-2 text-sm rounded-lg border border-charcoal/20">Batal</button>
                    <button wire:click="delete"
                        class="px-4 py-2 text-sm rounded-lg bg-blush text-white">Hapus</button>
                </div>
            </div>
        </div>
    @endif

    <livewire:admin.brosur.create />
    <livewire:admin.brosur.edit />
</div>