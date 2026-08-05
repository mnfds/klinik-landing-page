<footer class="bg-forest-dark text-ivory/90">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
        <!-- Brand -->
        <div class="space-y-4">
            <div class="flex items-center gap-2">
                {{-- <span class="flex items-center justify-center w-9 h-9 rounded-full bg-blush text-forest-dark"> --}}
                    <img src="{{ asset('images/logo/logo-no-text.png') }}" alt="{{ config('app.name', 'Klinik') }}" class="w-14 h-14 object-contain">
                {{-- </span> --}}
                <span class="font-display text-lg text-ivory">{{ config('app.name', 'Klinik') }}</span>
            </div>
            <p class="text-sm font-contax text-ivory/70 leading-relaxed max-w-xs">
                Perawatan kecantikan dan layanan medis dengan pendekatan yang tenang, aman, dan personal.
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h3 class="font-contax text-base text-ivory mb-4">Jelajahi</h3>
            <ul class="space-y-3 font-contax text-sm text-ivory/70">
                <li><a href="{{ Route::has('services') ? route('services') : '#' }}" wire:navigate class="hover:text-blush transition-colors">Layanan</a></li>
                <li><a href="{{ Route::has('products') ? route('products') : '#' }}" wire:navigate class="hover:text-blush transition-colors">Produk</a></li>
                <li><a href="{{ Route::has('doctors') ? route('doctors') : '#' }}" wire:navigate class="hover:text-blush transition-colors">Dokter</a></li>
                <li><a href="{{ Route::has('testimonials') ? route('testimonials') : '#' }}" wire:navigate class="hover:text-blush transition-colors">Testimoni</a></li>
            </ul>
        </div>

        <!-- Contact -->
        <div>
            <h3 class="font-contax text-base text-ivory mb-4">Kontak</h3>
            <ul class="space-y-3 font-contax text-sm text-ivory/70">
                <li>Jl. Gatot Subroto No.88, Kuripan, Kec. Banjarmasin Tim., Kota Banjarmasin, Kalimantan Selatan 70238</li>
                <li>
                    <a href="https://wa.me/6285822810149" target="_blank" rel="noopener" class="hover:text-blush transition-colors">
                        +62 858-2281-0149
                    </a>
                </li>
                <li>dokterlklinik@gmail.com</li>
            </ul>
        </div>

        <!-- Hours -->
        <div>
            <h3 class="font-contax text-base text-ivory mb-4">Jam Operasional</h3>
            <ul class="space-y-2 text-sm text-ivory/70">
                <li class="flex font-contax justify-between gap-4"><span>Senin – Sabtu</span><span>08.00–20.00</span></li>
                <li class="flex font-contax justify-between gap-4"><span>Minggu</span><span>09.00–17.00</span></li>
            </ul>
            <h3 class="font-contax text-base text-ivory mb-4 mt-4">Sosial Media</h3>
            <ul class="space-y-2 text-sm text-ivory/70">
                <li class="flex font-contax justify-between gap-4"><span><i class="fa-brands fa-instagram"></i> klinik_dokter_l</span><li>
                <li class="flex font-contax justify-between gap-4"><span><i class="fa-brands fa-tiktok"></i></i> klinik_dokter_l</span><li>
            </ul>
            {{-- Nanti diganti data dinamis dari tabel operational_hours --}}
        </div>
    </div>

    <div class="border-t border-ivory/10">
        <div class="max-w-7xl font-contax mx-auto px-6 lg:px-8 py-6 flex flex-col sm:flex-row justify-between items-center gap-3 text-xs text-ivory/50">
            <p>&copy; {{ now()->year }} {{ config('app.name', 'Klinik') }}. Seluruh hak cipta dilindungi.</p>
            <p>Dibuat dengan perhatian pada setiap detail.</p>
        </div>
    </div>
</footer>