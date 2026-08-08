<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="font-fraunces text-2xl text-forest">Kelola Dokter</h1>
            <p class="text-sm text-charcoal/60">Kelola daftar dokter beserta jadwal praktik.</p>
        </div>
        <button
            type="button"
            wire:click="$dispatch('open-create-doctor-modal')"
            class="px-4 py-2 bg-forest text-ivory rounded-lg text-sm hover:bg-forest-light transition"
        >
            + Tambah Dokter
        </button>
    </div>

    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-50 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="Cari dokter..."
            class="w-full sm:w-64 rounded-lg border-gray-300 text-sm focus:border-forest focus:ring-forest"
        >
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-ivory text-charcoal/70 text-left">
                <tr>
                    <th class="px-4 py-3">Foto</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Spesialisasi</th>
                    <th class="px-4 py-3">Jadwal</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($doctors as $doctor)
                    <tr wire:key="doctor-{{ $doctor->id }}">
                        <td class="px-4 py-3">
                            @if ($doctor->photo)
                                <img src="{{ \Storage::url($doctor->photo) }}" class="w-12 h-12 object-cover rounded-full">
                            @else
                                <div class="w-12 h-12 bg-gray-100 rounded-full"></div>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-charcoal">{{ $doctor->name }}</td>
                        <td class="px-4 py-3">{{ $doctor->specialization }}</td>
                        <td class="px-4 py-3 text-xs text-charcoal/60">
                            {{ $doctor->schedules_count }} jadwal
                        </td>
                        <td class="px-4 py-3">
                            <button
                                wire:click="toggleActive({{ $doctor->id }})"
                                class="px-2 py-1 rounded-full text-xs {{ $doctor->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}"
                            >
                                {{ $doctor->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <button
                                wire:click="$dispatch('open-edit-doctor-modal', { id: {{ $doctor->id }} })"
                                class="text-gold hover:underline text-xs"
                            >
                                Edit
                            </button>
                            <button
                                wire:click="confirmDelete({{ $doctor->id }})"
                                class="text-red-500 hover:underline text-xs"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-charcoal/50">
                            Belum ada dokter.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $doctors->links() }}
    </div>

    {{-- Modal konfirmasi hapus --}}
    @if ($deleteId)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4" wire:click.self="cancelDelete">
            <div class="bg-white rounded-xl p-6 max-w-sm w-full">
                <h3 class="font-fraunces text-lg text-forest mb-2">Hapus Dokter?</h3>
                <p class="text-sm text-charcoal/60 mb-6">Semua jadwal praktik dokter ini akan ikut terhapus.</p>
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

    <livewire:admin.doctors.create />
    <livewire:admin.doctors.edit />
</div>