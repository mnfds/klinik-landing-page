<nav
    x-data="{ open: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
    :class="scrolled ? 'bg-ivory/95 shadow-sm backdrop-blur' : 'bg-ivory/80'"
    class="sticky top-0 z-50 transition-all duration-300 border-b border-forest/10"
>
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
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
                    
                    <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
                        wire:navigate
                        class="relative text-sm font-medium text-charcoal/80 hover:text-forest transition-colors duration-200 after:absolute after:-bottom-1 after:left-0 after:h-px after:w-0 after:bg-gold after:transition-all after:duration-300 hover:after:w-full"
                    >
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>

            <!-- CTA -->
            <div class="hidden lg:block">
                
                <a href="https://wa.me/6280000000000"
                    target="_blank"
                    rel="noopener"
                    class="inline-flex items-center gap-2 rounded-full bg-forest px-5 py-2.5 text-sm font-medium text-ivory shadow-sm transition-all duration-300 hover:bg-forest-dark hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gold"
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

    <!-- Mobile Menu -->
    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="lg:hidden border-t border-forest/10 bg-ivory px-6 py-6 space-y-4"
    >
        @foreach ([
            ['label' => 'Beranda', 'route' => 'home'],
            ['label' => 'Layanan', 'route' => 'services'],
            ['label' => 'Produk', 'route' => 'products'],
            ['label' => 'Dokter', 'route' => 'doctors'],
            ['label' => 'Testimoni', 'route' => 'testimonials'],
        ] as $item)
            
            <a  href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
                wire:navigate
                class="block text-base font-medium text-charcoal/80 hover:text-forest"
            >
                {{ $item['label'] }}
            </a>
        @endforeach
        
         <a href="https://wa.me/6280000000000"
            target="_blank"
            rel="noopener"
            class="block text-center rounded-full bg-forest px-5 py-3 text-sm font-medium text-ivory"
        >
            Booking via WhatsApp
        </a>
    </div>
</nav>