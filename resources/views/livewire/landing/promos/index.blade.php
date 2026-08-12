<div>
    {{-- HEADER --}}
    <x-page-header
        label="{{ $this->banner->text_badge ?? 'Promo' }}"
        title="{{ $this->banner->text_title ?? 'Penawaran spesial untuk perawatanmu' }}"
        subtitle="{{ $this->banner->text_description ?? 'Cek promo yang sedang berlangsung sebelum booking treatment atau membeli produk.' }}"
        :image-desktop="$this->banner && $this->banner->image_desktop ? \Storage::url($this->banner->image_desktop) : asset('images/banner/promo.png')"
        :image-mobile="$this->banner && $this->banner->image_mobile ? \Storage::url($this->banner->image_mobile) : asset('images/banner/promo.png')"
    />

    @include('partials.landing.divider')

    <section class="bg-ivory border-b border-forest/10 py-2">
        <div class="max-w-5xl mx-auto px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-2xl font-contax text-forest text-center">
                    Cari Promo
                </h2>
                <p class="mt-2 text-center text-charcoal/70">
                    Temukan Promo yang menarik untuk anda.
                </p>

                <div class="relative mt-6">
                    <input
                        type="text"
                        placeholder="Cari layanan..."
                        class="w-full rounded-xl border border-forest/20 bg-white py-3 pl-12 pr-4 focus:border-forest focus:ring-2 focus:ring-forest/20 outline-none transition"
                    >

                    <svg
                        class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-charcoal/50"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m21 21-4.35-4.35m1.85-5.15a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                        />
                    </svg>
                </div>
            </div>
        </div>
    </section>

    {{-- GRID --}}
    <section class="bg-ivory py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                @forelse ($this->promosList as $promo)
                    <div wire:key="promo-{{ $promo->id }}" class="group relative h-full flex flex-col rounded-tl-[25px] rounded-ee-[25px] border border-forest/10 overflow-hidden bg-white transition-all duration-300 hover:-translate-y-1 hover:border-forest/30 hover:shadow-lg">
                        {{-- Badge "Segera Berakhir" --}}
                        @if ($promo->is_ending_soon)
                            <span class="absolute top-3 left-3 z-10 px-2.5 py-1 bg-red-500 text-ivory text-[10px] font-contax font-medium rounded-full">
                                Segera Berakhir
                            </span>
                        @endif

                        {{-- Image --}}
                        <div class="aspect-square bg-gradient-to-br from-blush/50 via-blush/20 to-ivory flex items-center justify-center overflow-hidden">
                            @if ($promo->image)
                                <img
                                    src="{{ \Storage::url($promo->image) }}"
                                    alt="{{ $promo->title }}"
                                    class="w-full h-full object-contain"
                                    loading="lazy"
                                >
                            @else
                                <svg viewBox="0 0 24 24" class="w-10 h-10 text-forest/25" fill="none" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 3h6l1 3h3a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V7a1 1 0 011-1h3l1-3z" />
                                </svg>
                            @endif
                        </div>
                        <div class="p-4 lg:p-6 flex flex-col flex-1">
                            <h3 class="font-contax text-base lg:text-lg text-forest-dark">
                                {{ $promo->title }}
                            </h3>

                            <p class="mt-2 font-contax text-sm text-charcoal/60 leading-relaxed line-clamp-2">
                                {{ $promo->description }}
                            </p>

                            <p class="mt-2 font-contax text-sm text-charcoal/60 leading-relaxed line-clamp-2">
                                {{ $this->formatPeriod($promo->start_date, $promo->end_date) }}
                            </p>

                            {{-- Grup price + button, selalu nempel di bawah & berdekatan --}}
                            <div class="mt-auto pt-4">
                                <p class="font-contax text-base lg:text-lg text-forest">
                                    {{ $promo->price ? 'Rp ' . number_format($promo->price, 0, ',', '.') : 'Hubungi Kami' }}
                                </p>

                                <div class="mt-3 flex flex-col gap-2">
                                    <a href="https://wa.me/6285822810149?text={{ urlencode('Halo, saya ingin tanya tentang promo ' . $promo->title) }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="block text-center rounded-full border border-forest/20 py-2 lg:py-2.5 text-[10px] lg:text-sm font-contax font-medium text-forest-dark transition-all duration-300 hover:bg-[#25D366] hover:text-white hover:border-[#1f8f48]"
                                    >
                                        <span class="lg:hidden">Tanya WhatsApp</span>
                                        <span class="hidden lg:inline">Tanya via WhatsApp</span>
                                    </a>
                                </div>
                            </div>
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