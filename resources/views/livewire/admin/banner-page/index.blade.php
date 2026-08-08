<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="font-fraunces text-2xl text-forest">Kelola Banner Page</h1>
            <p class="text-sm text-charcoal/60">Kelola banner untuk halaman dalam (services, products, dll).</p>
        </div>
        <button
            type="button"
            wire:click="$dispatch('open-create-banner-page-modal')"
            class="px-4 py-2 bg-forest text-ivory rounded-lg text-sm hover:bg-forest-light transition"
        >
            + Tambah Banner
        </button>
    </div>

    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-50 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <select wire:model.live="filterType" class="rounded-lg border-gray-300 text-sm focus:border-forest focus:ring-forest">
            <option value="">Semua Halaman</option>
            @foreach ($typeLabels as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-ivory text-charcoal/70 text-left">
                <tr>
                    <th class="px-4 py-3">Gambar</th>
                    <th class="px-4 py-3">Halaman</th>
                    <th class="px-4 py-3">Judul</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($banners as $banner)
                    <tr wire:key="banner-page-{{ $banner->id }}">
                        <td class="px-4 py-3">
                            @if ($banner->image_desktop)
                                <img src="{{ \Storage::url($banner->image_desktop) }}" class="w-16 h-10 object-cover rounded-lg">
                            @else
                                <div class="w-16 h-10 bg-gray-100 rounded-lg"></div>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 bg-blush/40 text-forest rounded-full text-xs">
                                {{ $typeLabels[$banner->type] ?? $banner->type }}
                            </span>
                        </td>
                        <td class="px-4 py-3 font-medium text-charcoal max-w-xs truncate">{{ $banner->text_title ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <button
                                wire:click="toggleActive({{ $banner->id }})"
                                class="px-2 py-1 rounded-full text-xs {{ $banner->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}"
                            >
                                {{ $banner->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <button
                                wire:click="$dispatch('open-edit-banner-page-modal', { id: {{ $banner->id }} })"
                                class="text-gold hover:underline text-xs"
                            >
                                Edit
                            </button>
                            <button
                                wire:click="confirmDelete({{ $banner->id }})"
                                class="text-red-500 hover:underline text-xs"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-charcoal/50">
                            Belum ada banner page.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $banners->links() }}
    </div>

    @if ($deleteId)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4" wire:click.self="cancelDelete">
            <div class="bg-white rounded-xl p-6 max-w-sm w-full">
                <h3 class="font-fraunces text-lg text-forest mb-2">Hapus Banner?</h3>
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

    <livewire:admin.banner-page.create />
    <livewire:admin.banner-page.edit />
</div>