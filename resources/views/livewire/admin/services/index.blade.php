<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="font-fraunces text-2xl text-forest">Kelola Layanan</h1>
            <p class="text-sm text-charcoal/60">Kelola daftar layanan treatment & medical.</p>
        </div>
        <button
            type="button"
            wire:click="$dispatch('open-create-service-modal')"
            class="px-4 py-2 bg-forest text-ivory rounded-lg text-sm hover:bg-forest-light transition"
        >
            + Tambah Layanan
        </button>
    </div>

    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-50 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col sm:flex-row gap-3 mb-4">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="Cari layanan..."
            class="w-full sm:w-64 rounded-lg border-gray-300 text-sm focus:border-forest focus:ring-forest"
        >
        <select wire:model.live="filterType" class="rounded-lg border-gray-300 text-sm focus:border-forest focus:ring-forest">
            <option value="">Semua Tipe</option>
            <option value="treatment">Treatment</option>
            <option value="medical">Medical</option>
        </select>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-ivory text-charcoal/70 text-left">
                <tr>
                    <th class="px-4 py-3">Gambar</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Tipe</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($services as $service)
                    <tr wire:key="service-{{ $service->id }}">
                        <td class="px-4 py-3">
                            @if ($service->image)
                                <img src="{{ \Storage::url($service->image) }}" class="w-12 h-12 object-cover rounded-lg">
                            @else
                                <div class="w-12 h-12 bg-gray-100 rounded-lg"></div>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-charcoal">{{ $service->name }}</td>
                        <td class="px-4 py-3 capitalize">{{ $service->type }}</td>
                        <td class="px-4 py-3">
                            {{ $service->price ? 'Rp ' . number_format($service->price, 0, ',', '.') : '-' }}
                        </td>
                        <td class="px-4 py-3">
                            <button
                                wire:click="toggleActive({{ $service->id }})"
                                class="px-2 py-1 rounded-full text-xs {{ $service->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}"
                            >
                                {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <button
                                wire:click="$dispatch('open-edit-service-modal', { id: {{ $service->id }} })"
                                class="text-gold hover:underline text-xs"
                            >
                                Edit
                            </button>
                            <button
                                wire:click="confirmDelete({{ $service->id }})"
                                class="text-red-500 hover:underline text-xs"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-charcoal/50">
                            Belum ada layanan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $services->links() }}
    </div>

    {{-- Modal konfirmasi hapus --}}
    @if ($deleteId)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4" wire:click.self="cancelDelete">
            <div class="bg-white rounded-xl p-6 max-w-sm w-full">
                <h3 class="font-fraunces text-lg text-forest mb-2">Hapus Layanan?</h3>
                <p class="text-sm text-charcoal/60 mb-6">Tindakan ini tidak dapat dibatalkan.</p>
                <div class="flex justify-end gap-3">
                    <button wire:click="cancelDelete" class="px-4 py-2 text-sm rounded-lg border border-gray-200">
                        Batal
                    </button>
                    <button wire:click="delete" class="px-4 py-2 text-sm rounded-lg bg-red-500 text-ivory">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    @endif

    <livewire:admin.services.create />
    <livewire:admin.services.edit />
</div>