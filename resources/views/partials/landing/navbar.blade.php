<div
    x-data="{ open: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
>
    <!-- Utility Bar (desktop only, FIXED - mengambang, tidak mendorong konten) -->
    <div
        x-show="!scrolled"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 -translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 -translate-y-0"
        class="hidden lg:flex fixed inset-x-2 lg:inset-x-20 z-50 justify-start items-center gap-4"
    >
        <div class="bg-forest text-ivory px-4 pt-2 pb-1.5 rounded-es-[15px] rounded-ee-[15px] transition-colors duration-300 hover:bg-forest-dark">
            <a
                href="https://wa.me/6285822810149?text={{ urlencode('Halo, saya ingin melakukan reservasi online.') }}"
                target="_blank"
                rel="noopener"
                class="font-contax text-sm"
            >
                ONLINE RESERVATION
            </a>
        </div>

        <div class="text-forest px-4 pt-2 pb-1.5 transition-colors duration-300 hover:text-forest-dark">
            <a
                href="https://maps.google.com"
                target="_blank"
                rel="noopener"
                class="font-contax text-sm"
            >
                OUR LOCATION
            </a>
        </div>

        <div class="text-forest px-4 pt-2 pb-1.5 transition-colors duration-300 hover:text-forest-dark">
            <a
                href="{{ asset('brochure.pdf') }}"
                target="_blank"
                rel="noopener"
                class="font-contax text-sm"
            >
                E-BROCHURE
            </a>
        </div>
    </div>

    <!-- Main Nav (fixed - mengambang di atas konten, transparan saat discroll) -->
    <nav
        :class="scrolled ? 'bg-ivory/80 shadow-md top-2' : 'bg-ivory/95 top-2 lg:top-12'"
        class="fixed inset-x-2 lg:inset-x-20 z-50 transition-all duration-300 border-2 rounded-xl border-forest/10"
    >
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-[4rem]">
                <!-- Logo -->
                <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-2 group">
                    {{-- <span class="flex items-center justify-center w-9 h-9 rounded-full bg-blush overflow-hidden transition-transform duration-300 group-hover:scale-105"> --}}
                        <img src="{{ asset('images/logo/logo-no-text.png') }}" alt="{{ config('app.name', 'Klinik') }}" class="w-12 h-12 object-contain">
                    {{-- </span> --}}
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
                            class="relative text-sm font-contax font-medium text-charcoal/80 hover:text-forest transition-colors duration-200 after:absolute after:-bottom-1 after:left-0 after:h-px after:w-0 after:bg-gold after:transition-all after:duration-300 hover:after:w-full"
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
                        class="inline-flex items-center gap-2 rounded-full bg-forest px-3 py-2.5 text-sm font-contax font-medium text-ivory shadow-sm transition-all duration-300 hover:bg-forest-dark hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gold"
                    >
                        Booking Now
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

    <!-- Mobile Menu (panel terpisah, mengambang dengan gap di bawah navbar) -->
    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        @click.outside="open = false"
        class="lg:hidden fixed top-20 left-2 right-2 z-40 rounded-lg border-2 border-forest/10 bg-ivory shadow-md px-6 py-6 space-y-4"
    >
        {{-- Nav Links --}}
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
                class="block text-base font-contax font-medium text-charcoal/80 hover:text-forest"
            >
                {{ $item['label'] }}
            </a>
        @endforeach

        {{-- Utility Links (Online Reservation, Our Location, E-Brochure) --}}
        <div class="pt-4 border-t border-forest/10 space-y-3">
            <a
                href="https://wa.me/6285822810149?text={{ urlencode('Halo, saya ingin melakukan reservasi online.') }}"
                target="_blank"
                rel="noopener"
                class="block text-base font-contax font-medium text-forest"
            >
                Online Reservation
            </a>
            <a
                href="https://maps.google.com"
                target="_blank"
                rel="noopener"
                class="block text-base font-contax font-medium text-charcoal/80 hover:text-forest"
            >
                OUR LOCATION
            </a>
            <a
                href="{{ asset('brochure.pdf') }}"
                target="_blank"
                rel="noopener"
                class="block text-base font-contax font-medium text-charcoal/80 hover:text-forest"
            >
                E-BROCHURE
            </a>
        </div>

        {{-- WhatsApp CTA --}}
        <a
            href="https://wa.me/6285822810149"
            target="_blank"
            rel="noopener"
            class="block font-contax text-center rounded-full bg-forest px-5 py-3 text-sm font-medium text-ivory"
        >
            Booking Now
        </a>
    </div>
</div>