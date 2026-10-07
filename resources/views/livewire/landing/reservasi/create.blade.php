<div>
    {{-- BREADCRUMB --}}
    <div class="bg-ivory border-b border-forest/10 pt-[70px] lg:pt-[110px]">
        <div class="max-w-5xl mx-auto px-6 lg:px-8 py-4 flex justify-end">
            <a href="{{ route('home') }}" wire:navigate class="text-sm font-contax text-charcoal/60 hover:text-forest transition-colors inline-flex items-center gap-1">
                <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>

    <section class="mx-auto max-w-2xl px-4 py-12 sm:py-16">
        @php
            $input = 'w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm focus:border-forest focus:outline-none focus:ring-1 focus:ring-forest disabled:bg-gray-100';
            $label = 'mb-1 block text-sm font-medium text-gray-700';
            $galat = 'mt-1 text-xs text-red-600';
        @endphp
        <header class="mb-8 text-center">
            <h1 class="font-contax text-2xl tracking-wide text-forest sm:text-3xl">RESERVASI ONLINE</h1>
            <p class="mt-3 text-sm text-gray-600">
                Isi formulir berikut. Tim kami akan menghubungi Anda untuk mengonfirmasi jadwal kunjungan.
            </p>
        </header>
    
        <ol class="mb-8 grid grid-cols-3 gap-3 text-center text-xs text-gray-600">
            <li class="rounded-lg bg-white p-3 shadow-sm"><span class="block font-semibold text-forest">1. Isi form</span>Pilih poli dan jadwal</li>
            <li class="rounded-lg bg-white p-3 shadow-sm"><span class="block font-semibold text-forest">2. Kami hubungi</span>Konfirmasi via telepon/WA</li>
            <li class="rounded-lg bg-white p-3 shadow-sm"><span class="block font-semibold text-forest">3. Datang</span>Sesuai jadwal terkonfirmasi</li>
        </ol>
    
        <div class="rounded-2xl bg-white p-6 shadow-md sm:p-8">
            @if ($sukses)
                <div class="py-8 text-center">
                    <p class="font-contax text-xl text-forest">PERMINTAAN TERKIRIM</p>
                    <p class="mt-3 text-sm text-gray-600">
                        Terima kasih. Tim kami akan menghubungi Anda melalui nomor yang didaftarkan untuk
                        mengonfirmasi jadwal. Reservasi baru dianggap pasti setelah dikonfirmasi.
                    </p>
                    <div class="mt-6 flex flex-col justify-center gap-3 sm:flex-row">
                        <a href="{{ route('home') }}" wire:navigate
                           class="rounded-lg bg-forest px-5 py-2 text-sm text-ivory transition-colors hover:bg-forest-dark">
                            Kembali ke Beranda
                        </a>
                        <button type="button" wire:click="kirimLagi"
                                class="rounded-lg border border-forest px-5 py-2 text-sm text-forest hover:bg-gray-50">
                            Kirim Permintaan Lain
                        </button>
                    </div>
                </div>
            @else
                <form wire:submit="kirim" class="space-y-5" novalidate>
    
                    @if ($pesanError)
                        <p class="rounded-lg bg-red-50 p-3 text-sm text-red-700">{{ $pesanError }}</p>
                    @endif
    
                    @if (empty($this->polis))
                        <p class="rounded-lg bg-yellow-50 p-3 text-sm text-yellow-800">
                            Daftar poliklinik tidak dapat dimuat. Silakan muat ulang halaman atau hubungi kami via WhatsApp.
                        </p>
                    @endif
    
                    <div>
                        <label class="{{ $label }}">Nama lengkap</label>
                        <input type="text" wire:model="nama" autocomplete="name" autocapitalize="characters"
                            class="{{ $input }} uppercase placeholder:normal-case">
                        @error('nama') <p class="{{ $galat }}">{{ $message }}</p> @enderror
                    </div>
    
                    <div>
                        <label class="{{ $label }}">Nomor HP / WhatsApp</label>
                        <input type="tel" inputmode="tel" wire:model="no_telp" autocomplete="tel" class="{{ $input }}">
                        @error('no_telp') <p class="{{ $galat }}">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="{{ $label }}">NIK <span class="font-normal text-gray-400">(opsional)</span></label>
                        <input type="text" wire:model="nik" inputmode="numeric" maxlength="16"
                            autocomplete="off" placeholder="16 digit" class="{{ $input }}">
                        <p class="mt-1 text-xs text-gray-500">
                            Digunakan untuk mencocokkan data pasien. Data Anda hanya dipakai untuk keperluan layanan klinik.
                        </p>
                        @error('nik') <p class="{{ $galat }}">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex flex-wrap gap-x-6 gap-y-2 text-sm">
                        <label class="flex items-center gap-2">
                            <input type="radio" value="baru" wire:model.live="status_pasien" class="accent-forest"> Pasien baru
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" value="lama" wire:model.live="status_pasien" class="accent-forest"> Sudah pernah berobat
                        </label>
                    </div>
    
                    @if ($status_pasien === 'lama')
                        <div>
                            <label class="{{ $label }}">No. Rekam Medis <span class="font-normal text-gray-400">(opsional)</span></label>
                            <input type="text" wire:model="no_register" class="{{ $input }}">
                            @error('no_register') <p class="{{ $galat }}">{{ $message }}</p> @enderror
                        </div>
                    @endif
    
                    <div>
                        <label class="{{ $label }}">Poliklinik</label>
                        <select wire:model.live="poli_id" class="{{ $input }}">
                            <option value="">Pilih poliklinik</option>
                            @foreach ($this->polis as $poli)
                                <option value="{{ $poli['id'] }}">{{ $poli['nama_poli'] }}</option>
                            @endforeach
                        </select>
                        @error('poli_id') <p class="{{ $galat }}">{{ $message }}</p> @enderror
                    </div>
    
                    <div>
                        <label class="{{ $label }}">Dokter <span class="font-normal text-gray-400">(opsional)</span></label>
                        <select wire:model="dokter_id" @disabled($poli_id === '') class="{{ $input }}">
                            <option value="">Dokter yang tersedia</option>
                            @foreach ($this->dokters as $dokter)
                                <option value="{{ $dokter['id'] }}">{{ $dokter['nama_dokter'] }}</option>
                            @endforeach
                        </select>
                        @error('dokter_id') <p class="{{ $galat }}">{{ $message }}</p> @enderror
                    </div>
    
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="{{ $label }}">Tanggal kunjungan</label>
                            {{-- x-data kosong supaya :min memakai tanggal di perangkat pengunjung, bukan tanggal server --}}
                            <input type="date" wire:model="tanggal_reservasi"
                                   x-data :min="new Date().toLocaleDateString('en-CA')"
                                   class="{{ $input }}">
                            @error('tanggal_reservasi') <p class="{{ $galat }}">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="{{ $label }}">Jam <span class="font-normal text-gray-400">(opsional)</span></label>
                            <input type="time" wire:model="jam_reservasi" class="{{ $input }}">
                            @error('jam_reservasi') <p class="{{ $galat }}">{{ $message }}</p> @enderror
                        </div>
                    </div>
    
                    <div>
                        <label class="{{ $label }}">Keluhan Anda <span class="font-normal text-gray-400">(opsional)</span></label>
                        <textarea wire:model="catatan" rows="3" maxlength="1000" class="{{ $input }}"></textarea>
                        @error('catatan') <p class="{{ $galat }}">{{ $message }}</p> @enderror
                    </div>
    
                    <button type="submit" wire:loading.attr="disabled" wire:target="kirim"
                            class="w-full rounded-lg bg-forest py-3 font-contax text-sm tracking-wide text-ivory transition-colors hover:bg-forest-dark disabled:opacity-60">
                        <span wire:loading.remove wire:target="kirim">RESERVASI SEKARANG</span>
                        <span wire:loading wire:target="kirim">MENGIRIM...</span>
                    </button>
    
                    <p class="text-center text-xs text-gray-500">
                        Lebih suka lewat chat?
                        <a href="https://wa.me/6285822810149?text={{ urlencode('Halo, saya ingin melakukan reservasi online.') }}"
                           target="_blank" rel="noopener" class="underline hover:text-forest">Hubungi kami via WhatsApp</a>
                    </p>
                </form>
            @endif
        </div>
    </section>
</div>