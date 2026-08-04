<!-- Utility Bar (desktop only, TIDAK sticky, ikut scroll hilang bersama halaman) -->
<div class="hidden lg:flex justify-start items-center gap-4 mx-2 lg:mx-20">
    <div class="bg-forest text-ivory px-4 pt-2 pb-1.5 rounded-es-[15px] rounded-ee-[15px] transition-colors duration-300 hover:bg-forest-dark">
        <a
            href="https://wa.me/6285822810149?text={{ urlencode('Halo, saya ingin melakukan reservasi online.') }}"
            target="_blank"
            rel="noopener"
            class="font-medium arsenal-regular text-md"
        >
            ONLINE RESERVATION
        </a>
    </div>

    <div class="text-forest px-4 pt-2 pb-1.5 transition-colors duration-300 hover:text-forest-dark">
        <a
            href="https://maps.google.com"
            target="_blank"
            rel="noopener"
            class="font-medium text-sm"
        >
            Our Location
        </a>
    </div>

    <div class="text-forest px-4 pt-2 pb-1.5 transition-colors duration-300 hover:text-forest-dark">
        <a
            href="{{ asset('brochure.pdf') }}"
            target="_blank"
            rel="noopener"
            class="font-medium text-sm"
        >
            E-BROCHURE
        </a>
    </div>
</div>

<!-- Main Nav (sticky, blur + transparan saat discroll) -->
<div
    x-data="{ open: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
    class="sticky top-5 z-50"
    >
    <nav
        :class="scrolled ? 'bg-ivory/80 shadow-lg' : 'bg-ivory/95'"
        class="transition-all duration-300 border-2 border-forest/10 rounded-xl mx-2 lg:mx-20 backdrop-blur-md mt-2"
    >
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-2 group">
                    <span class="flex items-center justify-center w-9 h-9 rounded-full bg-blush text-forest-dark transition-transform duration-300 group-hover:scale-105">
                        <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M12 3c-3 3-5 6-5 9a5 5 0 0010 0c0-3-2-6-5-9z" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <span class="font-display text-xl text-forest-dark tracking-tight">{{ config('app.name', 'Klinik') }}</span>
                </a>
    
                <!-- Desktop Nav -->
                <div class="hidden lg:flex items-center gap-10">
                    @foreach ([
                        ['label' => 'Beranda', 'route' => 'home'],
                        ['label' => 'Layanan', 'route' => 'services'],
                        ['label' => 'Produk', 'route' => 'products'],
                        ['label' => 'Promo', 'route' => 'promos'],
                        ['label' => 'Dokter', 'route' => 'doctors'],
                        ['label' => 'Testimoni', 'route' => 'testimonials'],
                    ] as $item)
                        <a
                            href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
                            wire:navigate
                            class="relative text-sm font-medium text-charcoal/80 hover:text-forest transition-colors duration-200 after:absolute after:-bottom-1 after:left-0 after:h-px after:w-0 after:bg-gold after:transition-all after:duration-300 hover:after:w-full"
                        >
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
    
                <!-- CTA -->
                <div class="hidden lg:block">
                    <a
                        href="https://wa.me/6285822810149"
                        target="_blank"
                        rel="noopener"
                        class="inline-flex items-center gap-2 rounded-full bg-forest px-3 py-2.5 text-sm font-medium text-ivory shadow-sm transition-all duration-300 hover:bg-forest-dark hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gold"
                    >
                        Booking via WhatsApp
                    </a>
                </div>
    
                <!-- Mobile Toggle -->
                <button
                    @click="open = !open"
                    class="lg:hidden p-2 text-forest-dark focus-visible:outline focus-visible:outline-2 focus-visible:outline-gold rounded-md"
                    aria-label="Buka menu"
                >
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                    </svg>
                    <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    
    </nav>
    <!-- Mobile Menu -->
    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
        class="absolute inset-x-2 top-full mt-3 lg:hidden rounded-2xl border border-forest/10 bg-ivory/95 backdrop-blur-xl shadow-2xl"
        >
        <div class="p-5">

            {{-- Navigation --}}
            <div class="space-y-1">
                @foreach ([
                    ['label' => 'Beranda', 'route' => 'home'],
                    ['label' => 'Layanan', 'route' => 'services'],
                    ['label' => 'Produk', 'route' => 'products'],
                    ['label' => 'Promo', 'route' => 'promos'],
                    ['label' => 'Dokter', 'route' => 'doctors'],
                    ['label' => 'Testimoni', 'route' => 'testimonials'],
                ] as $item)
                    <a
                        href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
                        wire:navigate
                        @click="open = false"
                        class="flex items-center justify-between rounded-xl px-4 py-3 text-[15px] font-medium text-charcoal transition-all duration-200 hover:bg-forest/5 hover:text-forest"
                    >
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </div>

            {{-- Divider --}}
            <div class="my-5 border-t border-forest/10"></div>

            {{-- Utility --}}
            <div>
                <div class="space-y-1">

                    <a
                        href="https://wa.me/6285822810149?text={{ urlencode('Halo, saya ingin melakukan reservasi online.') }}"
                        target="_blank"
                        rel="noopener"
                        class="flex items-center rounded-xl px-4 py-3 text-sm text-ivory bg-forest"
                    >
                        Online Reservation
                    </a>

                    <a
                        href="https://maps.google.com"
                        target="_blank"
                        rel="noopener"
                        class="flex items-center rounded-xl px-4 py-3 text-sm text-charcoal hover:bg-forest/5 hover:text-forest"
                    >
                        Our Location
                    </a>

                    <a
                        href="{{ asset('brochure.pdf') }}"
                        target="_blank"
                        rel="noopener"
                        class="flex items-center rounded-xl px-4 py-3 text-sm text-charcoal hover:bg-forest/5 hover:text-forest"
                    >
                        E-Brochure
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>