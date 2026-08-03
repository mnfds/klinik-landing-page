<div>
    {{-- HEADER --}}
    <section class="bg-forest-dark text-ivory py-20 lg:py-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <span class="text-xs font-medium tracking-wide uppercase text-blush">Promo</span>
            <h1 class="mt-3 font-display text-4xl sm:text-5xl leading-tight max-w-2xl">
                Penawaran spesial untuk perawatanmu
            </h1>
            <p class="mt-4 text-ivory/70 max-w-xl">
                Cek promo yang sedang berlangsung sebelum booking treatment atau membeli produk.
            </p>
        </div>
    </section>

    @include('partials.landing.divider')

    {{-- GRID --}}
    <section class="bg-ivory py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($this->promosList as $promo)
                    <div wire:key="promo-{{ $loop->index }}" class="group rounded-2xl border border-forest/10 overflow-hidden bg-white transition-all duration-300 hover:border-forest/30 hover:shadow-md">

                        {{-- Image placeholder --}}
                        <div class="relative aspect-[16/9] bg-gradient-to-br from-blush/50 via-blush/20 to-ivory flex items-center justify-center">
                            <svg viewBox="0 0 24 24" class="w-10 h-10 text-forest/25" fill="none" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h6m-9 8h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>

                            @if ($promo['is_ending_soon'])
                                <span class="absolute top-3 right-3 rounded-full bg-gold px-3 py-1 text-[11px] font-medium text-ivory shadow-sm">
                                    Segera Berakhir
                                </span>
                            @endif
                        </div>

                        <div class="p-6">
                            <h3 class="font-display text-lg text-forest-dark leading-snug">
                                {{ $promo['title'] }}
                            </h3>

                            <p class="mt-2 text-sm text-charcoal/60 leading-relaxed">
                                {{ $promo['description'] }}
                            </p>

                            <p class="mt-4 text-xs text-charcoal/40">
                                {{ $this->formatPeriod($promo['start_date'], $promo['end_date']) }}
                            </p>

                            
                            <a href="https://wa.me/6280000000000?text={{ urlencode('Halo, saya ingin tanya tentang promo ' . $promo['title']) }}"
                                target="_blank"
                                rel="noopener"
                                class="mt-5 block text-center rounded-full bg-forest py-2.5 text-sm font-medium text-ivory transition-all duration-300 hover:bg-forest-dark"
                            >
                                Tanya via WhatsApp
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <p class="text-charcoal/50">Belum ada promo yang sedang berlangsung.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>