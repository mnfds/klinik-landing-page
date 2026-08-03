<div>
    {{-- BREADCRUMB --}}
    <div class="bg-ivory border-b border-forest/10">
        <div class="max-w-5xl mx-auto px-6 lg:px-8 py-4">
            <a href="{{ route('products') }}" wire:navigate class="text-sm text-charcoal/60 hover:text-forest transition-colors inline-flex items-center gap-1">
                <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Produk
            </a>
        </div>
    </div>

    {{-- DETAIL --}}
    <section class="py-16 lg:py-20">
        <div class="max-w-5xl mx-auto px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-start">

            {{-- Image --}}
            <div class="aspect-square rounded-3xl bg-gradient-to-br from-blush/50 via-blush/20 to-ivory border border-forest/10 flex items-center justify-center overflow-hidden">
                <svg viewBox="0 0 24 24" class="w-16 h-16 text-forest/25" fill="none" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 3h6l1 3h3a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V7a1 1 0 011-1h3l1-3z" />
                </svg>
            </div>

            {{-- Content --}}
            <div>
                <span class="text-xs font-medium tracking-wide uppercase text-gold">
                    Produk Perawatan
                </span>

                <h1 class="mt-3 font-display text-3xl sm:text-4xl text-forest-dark leading-tight">
                    {{ $product['name'] }}
                </h1>

                <p class="mt-3 font-display text-2xl text-forest">
                    Rp {{ number_format($product['price'], 0, ',', '.') }}
                </p>

                <p class="mt-6 text-charcoal/70 leading-relaxed">
                    {{ $product['description'] }}
                </p>

                <div class="mt-4 rounded-xl bg-blush/20 border border-blush/40 px-4 py-3 text-sm text-charcoal/70">
                    Produk ini tersedia untuk dibeli langsung di klinik atau lewat konsultasi WhatsApp — belum ada pemesanan online.
                </div>

                <div class="mt-8 flex flex-col sm:flex-row gap-3">
                    
                    <a href="https://wa.me/6280000000000?text={{ urlencode('Halo, saya ingin tanya/beli produk ' . $product['name']) }}"
                        target="_blank"
                        rel="noopener"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-forest px-6 py-3.5 text-sm font-medium text-ivory shadow-sm transition-all duration-300 hover:bg-forest-dark hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gold"
                    >
                        Tanya / Beli via WhatsApp
                    </a>
                    
                    <a href="{{ route('products') }}"
                        wire:navigate
                        class="inline-flex items-center justify-center gap-2 rounded-full border border-forest/20 px-6 py-3.5 text-sm font-medium text-forest-dark transition-all duration-300 hover:border-forest hover:bg-forest/5"
                    >
                        Lihat Produk Lain
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>