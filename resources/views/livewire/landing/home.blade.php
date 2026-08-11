<div>
    {{-- HERO CAROUSEL --}}
    @if ($this->featuredBanner->count() > 0)
        <section
            x-data="{
                active: 0,
                slides: {{ $this->featuredBanner->count() }},
                interval: null,
                start() {
                    this.interval = setInterval(() => this.next(), 6000)
                },
                next() {
                    this.active = (this.active + 1) % this.slides
                },
                prev() {
                    this.active = (this.active - 1 + this.slides) % this.slides
                },
                goTo(i) {
                    this.active = i
                    clearInterval(this.interval)
                    this.start()
                }
            }"
            x-init="start()"
            class="relative h-[100dvh] w-full overflow-hidden"
            >
            @foreach ($this->featuredBanner as $banner)
            <div
                wire:key="home-banner-{{ $banner->id }}"
                x-show="active === {{ $loop->index }}"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0"
                >
                {{-- Background: mobile pakai gambar mobile, sm ke atas pakai gambar desktop --}}
                @if ($banner->image_mobile)
                    <div
                        class="absolute inset-0 bg-cover bg-center sm:hidden"
                        style="background-image: url('{{ \Storage::url($banner->image_mobile) }}')"
                    ></div>
                @endif

                @if ($banner->image_desktop)
                    <div
                        class="absolute inset-0 bg-cover bg-center hidden sm:block"
                        style="background-image: url('{{ \Storage::url($banner->image_desktop) }}')"
                    ></div>
                @endif

                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/60 to-transparent sm:bg-gradient-to-r sm:from-ivory/95 sm:via-ivory/60 sm:to-transparent"></div>

                <div class="relative h-full overflow-y-auto pt-20 sm:pt-24 pb-6">
                    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 h-full flex items-end">
                        <div class="max-w-2xl w-full">
                            @if ($banner->text_badge)
                                <span class="inline-flex items-center gap-2 text-[11px] sm:text-xs font-contax font-medium tracking-wide uppercase text-ivory sm:text-forest/70 bg-forest/40 sm:bg-blush/40 rounded-full px-3.5 py-1.5">
                                    {{ $banner->text_badge }}
                                </span>
                            @endif

                            @if ($banner->text_title)
                                <h1 class="mt-4 sm:mt-6 font-contax font-bold text-2xl xs:text-3xl sm:text-5xl lg:text-6xl leading-[1.15] sm:leading-[1.1] text-ivory sm:text-forest-dark">
                                    {{ $banner->text_title }}
                                </h1>
                            @endif

                            @if ($banner->text_description)
                                <p class="mt-3 sm:mt-6 font-contax text-sm sm:text-lg text-ivory/80 sm:text-charcoal/70 leading-relaxed max-w-lg">
                                    {{ $banner->text_description }}
                                </p>
                            @endif

                            <div class="mt-5 sm:mt-10">
                                <a href="https://wa.me/6285822810149"
                                    target="_blank"
                                    rel="noopener"
                                    class="inline-flex items-center justify-center gap-2 rounded-full bg-forest px-6 py-3 sm:py-3.5 text-sm font-contax font-medium text-ivory shadow-sm transition-all duration-300 hover:bg-forest-dark hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gold"
                                >
                                    Booking via WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- DOT INDICATORS --}}
            <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex items-center gap-3 z-10">
                <template x-for="i in slides" :key="i">
                    <button
                        @click="goTo(i - 1)"
                        :class="active === i - 1 ? 'bg-forest w-8' : 'bg-forest-dark/50 w-2.5 hover:bg-forest'"
                        class="h-2.5 rounded-full transition-all duration-300"
                        :aria-label="'Slide ' + i"
                    ></button>
                </template>
            </div>
        </section>
    @endif

    @include('partials.landing.divider')

    {{-- PROMO AKTIF --}}
    @if ($this->promos->count() > 0)
        @php
            $desktopSlides = $this->promos->chunk(3)->values();
        @endphp

        <section class="bg-blush/20 py-16 lg:py-20">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="relative flex flex-col items-center gap-2 text-center lg:flex-row lg:items-end lg:justify-center lg:gap-4">
                    <div class="text-center">
                        <h2 class="mt-3 font-contax text-3xl font-medium sm:text-4xl text-forest-dark">
                            What's New at Dokter L Clinic
                        </h2>
                    </div>

                    <a href="{{ Route::has('promos') ? route('promos') : '#' }}"
                        wire:navigate
                        class="text-sm font-contax text-forest-dark border-b border-gold hover:text-forest transition-colors
                            lg:absolute lg:right-0 lg:bottom-0"
                    >
                        Lihat Semua Promo →
                    </a>
                </div>

                {{-- ============ DESKTOP CAROUSEL: 3 CARD/SLIDE, FOTO BOX (1:1) ============ --}}
                <div
                    x-data="{
                        activeIndex: 0,
                        total: {{ $desktopSlides->count() }},
                        autoSlide: null,
                        next() { this.activeIndex = (this.activeIndex + 1) % this.total; },
                        prev() { this.activeIndex = (this.activeIndex - 1 + this.total) % this.total; },
                        goTo(i) { this.activeIndex = i; this.restart(); },
                        startAutoSlide() { this.autoSlide = setInterval(() => this.next(), 4000); },
                        stopAutoSlide() { clearInterval(this.autoSlide); },
                        restart() { this.stopAutoSlide(); this.startAutoSlide(); }
                    }"
                    x-init="startAutoSlide()"
                    @mouseenter="stopAutoSlide()"
                    @mouseleave="startAutoSlide()"
                    class="hidden md:block mt-10 relative"
                    >
                    {{-- Track --}}
                    <div class="overflow-hidden">
                        <div
                            class="flex transition-transform duration-500 ease-in-out"
                            :style="`transform: translateX(-${activeIndex * 100}%)`"
                        >
                            @foreach ($desktopSlides as $slide)
                                <div wire:key="home-promo-desktop-slide-{{ $loop->index }}" class="w-full flex-shrink-0 grid grid-cols-3 gap-6 lg:gap-8 px-1">
                                    @foreach ($slide as $promo)
                                        <div wire:key="home-promo-desktop-{{ $promo->id }}"
                                            class="group h-full flex flex-col rounded-tl-[25px] rounded-ee-[25px] border border-forest/10 overflow-hidden bg-white transition-all duration-300 hover:border-forest/30 hover:shadow-md"
                                            >
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

                                            <div class="p-7 flex flex-col flex-1">
                                                <h3 class="font-contax text-lg text-forest-dark">{{ $promo->title }}</h3>

                                                <p class="mt-2 font-contax text-sm text-charcoal/60 leading-relaxed line-clamp-2">
                                                    {{ $promo->description }}
                                                </p>

                                                <p class="mt-2 font-contax text-sm text-charcoal/60 leading-relaxed line-clamp-2">
                                                    {{ $this->formatPeriod($promo->start_date, $promo->end_date) }}
                                                </p>

                                                {{-- Grup price + button, selalu nempel di bawah --}}
                                                <div class="mt-auto pt-4">
                                                    <p class="font-contax text-base lg:text-lg text-forest">
                                                        {{ $promo->price ? 'Rp ' . number_format($promo->price, 0, ',', '.') : 'Hubungi Kami' }}
                                                    </p>

                                                    <div class="mt-3">
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
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Nav Arrows --}}
                    @if ($desktopSlides->count() > 1)
                        <button
                            @click="prev(); restart()"
                            aria-label="Sebelumnya"
                            class="absolute top-1/2 -translate-y-1/2 -left-4 lg:-left-6 w-10 h-10 rounded-full bg-white border border-forest/10 shadow flex items-center justify-center text-forest-dark hover:bg-forest-dark hover:text-white transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button
                            @click="next(); restart()"
                            aria-label="Selanjutnya"
                            class="absolute top-1/2 -translate-y-1/2 -right-4 lg:-right-6 w-10 h-10 rounded-full bg-white border border-forest/10 shadow flex items-center justify-center text-forest-dark hover:bg-forest-dark hover:text-white transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    @endif

                    {{-- Dots --}}
                    @if ($desktopSlides->count() > 1)
                        <div class="flex justify-center gap-2 mt-6">
                            @foreach ($desktopSlides as $slide)
                                <button
                                    @click="goTo({{ $loop->index }})"
                                    class="w-2 h-2 rounded-full transition-all duration-300"
                                    :class="activeIndex === {{ $loop->index }} ? 'bg-forest-dark w-8' : 'bg-forest/20'"
                                ></button>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- ============ MOBILE CAROUSEL: 1 CARD/SLIDE, FOTO BOX (1:1) ============ --}}
                <div
                    x-data="{
                        activeIndex: 0,
                        total: {{ $this->promos->count() }},
                        autoSlide: null,
                        next() { this.activeIndex = (this.activeIndex + 1) % this.total; },
                        prev() { this.activeIndex = (this.activeIndex - 1 + this.total) % this.total; },
                        goTo(i) { this.activeIndex = i; this.restart(); },
                        startAutoSlide() { this.autoSlide = setInterval(() => this.next(), 4000); },
                        stopAutoSlide() { clearInterval(this.autoSlide); },
                        restart() { this.stopAutoSlide(); this.startAutoSlide(); }
                    }"
                    x-init="startAutoSlide()"
                    @mouseenter="stopAutoSlide()"
                    @mouseleave="startAutoSlide()"
                    class="md:hidden mt-10 relative max-w-md mx-auto"
                    >
                    {{-- Track --}}
                    <div class="overflow-hidden">
                        <div
                            class="flex transition-transform duration-500 ease-in-out"
                            :style="`transform: translateX(-${activeIndex * 100}%)`"
                        >
                            @foreach ($this->promos as $promo)
                                <div wire:key="home-promo-mobile-{{ $promo->id }}" class="w-full flex-shrink-0 px-1">
                                    <div class="group h-full flex flex-col rounded-tl-[25px] rounded-ee-[25px] border border-forest/10 overflow-hidden bg-white transition-all duration-300 hover:border-forest/30 hover:shadow-md">
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

                                        <div class="p-7 flex flex-col flex-1">
                                            <h3 class="font-contax text-lg text-forest-dark">{{ $promo->title }}</h3>

                                            <p class="mt-2 font-contax text-sm text-charcoal/60 leading-relaxed line-clamp-2">
                                                {{ $promo->description }}
                                            </p>

                                            <p class="mt-2 font-contax text-sm text-charcoal/60 leading-relaxed line-clamp-2">
                                                {{ $this->formatPeriod($promo->start_date, $promo->end_date) }}
                                            </p>

                                            <div class="mt-auto pt-4">
                                                <p class="font-contax text-base lg:text-lg text-forest">
                                                    {{ $promo->price ? 'Rp ' . number_format($promo->price, 0, ',', '.') : 'Hubungi Kami' }}
                                                </p>

                                                <div class="mt-3">
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
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Nav Arrows --}}
                    @if ($this->promos->count() > 1)
                        <button
                            @click="prev(); restart()"
                            aria-label="Sebelumnya"
                            class="absolute top-1/2 -translate-y-1/2 -left-2 w-9 h-9 rounded-full bg-white border border-forest/10 shadow flex items-center justify-center text-forest-dark hover:bg-forest-dark hover:text-white transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button
                            @click="next(); restart()"
                            aria-label="Selanjutnya"
                            class="absolute top-1/2 -translate-y-1/2 -right-2 w-9 h-9 rounded-full bg-white border border-forest/10 shadow flex items-center justify-center text-forest-dark hover:bg-forest-dark hover:text-white transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    @endif

                    {{-- Dots --}}
                    @if ($this->promos->count() > 1)
                        <div class="flex justify-center gap-2 mt-5">
                            @foreach ($this->promos as $promo)
                                <button
                                    @click="goTo({{ $loop->index }})"
                                    class="w-2 h-2 rounded-full transition-all duration-300"
                                    :class="activeIndex === {{ $loop->index }} ? 'bg-forest-dark w-8' : 'bg-forest/20'"
                                ></button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>

        @include('partials.landing.divider')
    @endif

    {{-- CUPLIKAN LAYANAN --}}
    @if ($this->featuredServices->count() > 0)
        @php
            $mobileServiceSlides = $this->featuredServices->chunk(2)->values();
            $desktopServiceSlides = $this->featuredServices->chunk(4)->values();
        @endphp

        <section class="text-ivory py-20 lg:py-28 bg-gradient-to-b from-forest-dark/95 via-forest/95 to-forest/95">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex items-end justify-between gap-4 flex-wrap">
                    <div class="max-w-xl">
                        <span class="text-xs font-contax font-medium tracking-wide uppercase text-ivory">Layanan Kami</span>
                        <h2 class="mt-3 font-contax text-3xl sm:text-4xl text-ivory">
                            Temukan treatment terbaik untuk kulitmu
                        </h2>
                    </div>

                    <a href="{{ Route::has('services') ? route('services') : '#' }}"
                        wire:navigate
                        class="text-sm font-contax font-medium text-ivory border-b border-gold hover:text-gold transition-colors"
                    >
                        Lihat Semua Layanan →
                    </a>
                </div>

                {{-- ============ MOBILE CAROUSEL: 2 CARD/SLIDE ============ --}}
                <div
                    x-data="{
                        activeIndex: 0,
                        total: {{ $mobileServiceSlides->count() }},
                        autoSlide: null,
                        next() { this.activeIndex = (this.activeIndex + 1) % this.total; },
                        prev() { this.activeIndex = (this.activeIndex - 1 + this.total) % this.total; },
                        goTo(i) { this.activeIndex = i; this.restart(); },
                        startAutoSlide() { this.autoSlide = setInterval(() => this.next(), 4000); },
                        stopAutoSlide() { clearInterval(this.autoSlide); },
                        restart() { this.stopAutoSlide(); this.startAutoSlide(); }
                    }"
                    x-init="startAutoSlide()"
                    @mouseenter="stopAutoSlide()"
                    @mouseleave="startAutoSlide()"
                    class="md:hidden mt-10 relative"
                >
                    <div class="overflow-hidden">
                        <div
                            class="flex transition-transform duration-500 ease-in-out"
                            :style="`transform: translateX(-${activeIndex * 100}%)`"
                        >
                            @foreach ($mobileServiceSlides as $slide)
                                <div wire:key="home-service-mobile-slide-{{ $loop->index }}" class="w-full flex-shrink-0 grid grid-cols-2 gap-5 px-1">
                                    @foreach ($slide as $service)
                                        <a href="{{ Route::has('services.detail') ? route('services.detail', $service->id) : '#' }}"
                                            wire:navigate
                                            wire:key="home-service-mobile-{{ $service->id }}"
                                            class="group rounded-tl-[25px] rounded-ee-[25px] border border-charcoal/10 overflow-hidden bg-white transition-all duration-300 hover:border-forest/30 hover:shadow-md"
                                        >
                                            <div class="aspect-square bg-gradient-to-br from-blush/50 via-blush/20 to-ivory flex items-center justify-center overflow-hidden">
                                                @if ($service->image)
                                                    <img
                                                        src="{{ \Storage::url($service->image) }}"
                                                        alt="{{ $service->name }}"
                                                        class="w-full h-full object-contain"
                                                        loading="lazy"
                                                    >
                                                @else
                                                    <svg viewBox="0 0 24 24" class="w-8 h-8 text-forest/25" fill="none" stroke="currentColor" stroke-width="1">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 3h6l1 3h3a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V7a1 1 0 011-1h3l1-3z" />
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="p-4">
                                                <p class="text-sm font-contax font-medium text-forest-dark leading-snug">{{ $service->name }}</p>
                                                <p class="mt-1 font-contax text-sm text-charcoal/50">
                                                    {{ $service->price ? 'Rp ' . number_format($service->price, 0, ',', '.') : 'Hubungi Kami' }}
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if ($mobileServiceSlides->count() > 1)
                        <button
                            @click="prev(); restart()"
                            aria-label="Sebelumnya"
                            class="absolute top-1/2 -translate-y-1/2 -left-2 w-9 h-9 rounded-full bg-white border border-charcoal/10 shadow flex items-center justify-center text-forest-dark hover:bg-forest-dark hover:text-white transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button
                            @click="next(); restart()"
                            aria-label="Selanjutnya"
                            class="absolute top-1/2 -translate-y-1/2 -right-2 w-9 h-9 rounded-full bg-white border border-charcoal/10 shadow flex items-center justify-center text-forest-dark hover:bg-forest-dark hover:text-white transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        <div class="flex justify-center gap-2 mt-6">
                            @foreach ($mobileServiceSlides as $slide)
                                <button
                                    @click="goTo({{ $loop->index }})"
                                    class="w-2 h-2 rounded-full transition-all duration-300"
                                    :class="activeIndex === {{ $loop->index }} ? 'bg-ivory w-8' : 'bg-ivory/30 w-2.5 hover:bg-ivory/50'"
                                ></button>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- ============ DESKTOP CAROUSEL: 4 CARD/SLIDE ============ --}}
                <div
                    x-data="{
                        activeIndex: 0,
                        total: {{ $desktopServiceSlides->count() }},
                        autoSlide: null,
                        next() { this.activeIndex = (this.activeIndex + 1) % this.total; },
                        prev() { this.activeIndex = (this.activeIndex - 1 + this.total) % this.total; },
                        goTo(i) { this.activeIndex = i; this.restart(); },
                        startAutoSlide() { this.autoSlide = setInterval(() => this.next(), 4000); },
                        stopAutoSlide() { clearInterval(this.autoSlide); },
                        restart() { this.stopAutoSlide(); this.startAutoSlide(); }
                    }"
                    x-init="startAutoSlide()"
                    @mouseenter="stopAutoSlide()"
                    @mouseleave="startAutoSlide()"
                    class="hidden md:block mt-10 relative"
                >
                    <div class="overflow-hidden">
                        <div
                            class="flex transition-transform duration-500 ease-in-out"
                            :style="`transform: translateX(-${activeIndex * 100}%)`"
                        >
                            @foreach ($desktopServiceSlides as $slide)
                                <div wire:key="home-service-desktop-slide-{{ $loop->index }}" class="w-full flex-shrink-0 grid grid-cols-4 gap-5 px-1">
                                    @foreach ($slide as $service)
                                        <a href="{{ Route::has('services.detail') ? route('services.detail', $service->id) : '#' }}"
                                            wire:navigate
                                            wire:key="home-service-desktop-{{ $service->id }}"
                                            class="group rounded-tl-[25px] rounded-ee-[25px] border border-charcoal/10 overflow-hidden bg-white transition-all duration-300 hover:border-forest/30 hover:shadow-md"
                                        >
                                            <div class="aspect-square bg-gradient-to-br from-blush/50 via-blush/20 to-ivory flex items-center justify-center overflow-hidden">
                                                @if ($service->image)
                                                    <img
                                                        src="{{ \Storage::url($service->image) }}"
                                                        alt="{{ $service->name }}"
                                                        class="w-full h-full object-contain"
                                                        loading="lazy"
                                                    >
                                                @else
                                                    <svg viewBox="0 0 24 24" class="w-8 h-8 text-forest/25" fill="none" stroke="currentColor" stroke-width="1">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 3h6l1 3h3a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V7a1 1 0 011-1h3l1-3z" />
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="p-4">
                                                <p class="text-sm font-contax font-medium text-forest-dark leading-snug">{{ $service->name }}</p>
                                                <p class="mt-1 font-contax text-sm text-charcoal/50">
                                                    {{ $service->price ? 'Rp ' . number_format($service->price, 0, ',', '.') : 'Hubungi Kami' }}
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if ($desktopServiceSlides->count() > 1)
                        <button
                            @click="prev(); restart()"
                            aria-label="Sebelumnya"
                            class="absolute top-1/2 -translate-y-1/2 -left-4 lg:-left-6 w-10 h-10 rounded-full bg-white border border-charcoal/10 shadow flex items-center justify-center text-forest-dark hover:bg-forest-dark hover:text-white transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button
                            @click="next(); restart()"
                            aria-label="Selanjutnya"
                            class="absolute top-1/2 -translate-y-1/2 -right-4 lg:-right-6 w-10 h-10 rounded-full bg-white border border-charcoal/10 shadow flex items-center justify-center text-forest-dark hover:bg-forest-dark hover:text-white transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        <div class="flex justify-center gap-2 mt-6">
                            @foreach ($desktopServiceSlides as $slide)
                                <button
                                    @click="goTo({{ $loop->index }})"
                                    class="w-2 h-2 rounded-full transition-all duration-300"
                                    :class="activeIndex === {{ $loop->index }} ? 'bg-ivory w-8' : 'bg-ivory/30'"
                                ></button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>
        @include('partials.landing.divider')
    @endif

    @include('partials.landing.divider')

    {{-- CUPLIKAN PRODUK --}}
    @if ($this->featuredProducts->count() > 0)
        @php
            $mobileProductSlides = $this->featuredProducts->chunk(2)->values();
            $desktopProductSlides = $this->featuredProducts->chunk(4)->values();
        @endphp

        <section class="bg-ivory py-20 lg:py-28">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex items-end justify-between gap-4 flex-wrap">
                    <div class="max-w-xl">
                        <span class="text-xs font-contax font-medium tracking-wide uppercase text-gold">Produk Kami</span>
                        <h2 class="mt-3 font-contax text-3xl sm:text-4xl text-forest-dark">
                            Lanjutkan perawatan di rumah
                        </h2>
                    </div>

                    <a href="{{ Route::has('products') ? route('products') : '#' }}"
                        wire:navigate
                        class="text-sm font-contax font-medium text-forest-dark border-b border-gold hover:text-forest transition-colors"
                    >
                        Lihat Semua Produk →
                    </a>
                </div>

                {{-- ============ MOBILE CAROUSEL: 2 CARD/SLIDE ============ --}}
                <div
                    x-data="{
                        activeIndex: 0,
                        total: {{ $mobileProductSlides->count() }},
                        autoSlide: null,
                        next() { this.activeIndex = (this.activeIndex + 1) % this.total; },
                        prev() { this.activeIndex = (this.activeIndex - 1 + this.total) % this.total; },
                        goTo(i) { this.activeIndex = i; this.restart(); },
                        startAutoSlide() { this.autoSlide = setInterval(() => this.next(), 4000); },
                        stopAutoSlide() { clearInterval(this.autoSlide); },
                        restart() { this.stopAutoSlide(); this.startAutoSlide(); }
                    }"
                    x-init="startAutoSlide()"
                    @mouseenter="stopAutoSlide()"
                    @mouseleave="startAutoSlide()"
                    class="md:hidden mt-10 relative"
                >
                    <div class="overflow-hidden">
                        <div
                            class="flex transition-transform duration-500 ease-in-out"
                            :style="`transform: translateX(-${activeIndex * 100}%)`"
                        >
                            @foreach ($mobileProductSlides as $slide)
                                <div wire:key="home-product-mobile-slide-{{ $loop->index }}" class="w-full flex-shrink-0 grid grid-cols-2 gap-5 px-1">
                                    @foreach ($slide as $product)
                                        <a href="{{ Route::has('products.detail') ? route('products.detail', $product->id) : '#' }}"
                                            wire:navigate
                                            wire:key="home-product-mobile-{{ $product->id }}"
                                            class="group rounded-tl-[25px] rounded-ee-[25px] border border-forest/10 overflow-hidden bg-white transition-all duration-300 hover:border-forest/30 hover:shadow-md"
                                        >
                                            <div class="aspect-square bg-gradient-to-br from-blush/50 via-blush/20 to-ivory flex items-center justify-center overflow-hidden">
                                                @if ($product->image)
                                                    <img
                                                        src="{{ \Storage::url($product->image) }}"
                                                        alt="{{ $product->name }}"
                                                        class="w-full h-full object-contain"
                                                        loading="lazy"
                                                    >
                                                @else
                                                    <svg viewBox="0 0 24 24" class="w-8 h-8 text-forest/25" fill="none" stroke="currentColor" stroke-width="1">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 3h6l1 3h3a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V7a1 1 0 011-1h3l1-3z" />
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="p-4">
                                                <p class="text-sm font-contax font-medium text-forest-dark leading-snug">{{ $product->name }}</p>
                                                <p class="mt-1 font-contax text-sm text-charcoal/50">
                                                    {{ $product->price ? 'Rp ' . number_format($product->price, 0, ',', '.') : 'Hubungi Kami' }}
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if ($mobileProductSlides->count() > 1)
                        <button
                            @click="prev(); restart()"
                            aria-label="Sebelumnya"
                            class="absolute top-1/2 -translate-y-1/2 -left-2 w-9 h-9 rounded-full bg-white border border-forest/10 shadow flex items-center justify-center text-forest-dark hover:bg-forest-dark hover:text-white transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button
                            @click="next(); restart()"
                            aria-label="Selanjutnya"
                            class="absolute top-1/2 -translate-y-1/2 -right-2 w-9 h-9 rounded-full bg-white border border-forest/10 shadow flex items-center justify-center text-forest-dark hover:bg-forest-dark hover:text-white transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        <div class="flex justify-center gap-2 mt-6">
                            @foreach ($mobileProductSlides as $slide)
                                <button
                                    @click="goTo({{ $loop->index }})"
                                    class="w-2 h-2 rounded-full transition-all duration-300"
                                    :class="activeIndex === {{ $loop->index }} ? 'bg-forest-dark w-8' : 'bg-forest/20'"
                                ></button>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- ============ DESKTOP CAROUSEL: 4 CARD/SLIDE ============ --}}
                <div
                    x-data="{
                        activeIndex: 0,
                        total: {{ $desktopProductSlides->count() }},
                        autoSlide: null,
                        next() { this.activeIndex = (this.activeIndex + 1) % this.total; },
                        prev() { this.activeIndex = (this.activeIndex - 1 + this.total) % this.total; },
                        goTo(i) { this.activeIndex = i; this.restart(); },
                        startAutoSlide() { this.autoSlide = setInterval(() => this.next(), 4000); },
                        stopAutoSlide() { clearInterval(this.autoSlide); },
                        restart() { this.stopAutoSlide(); this.startAutoSlide(); }
                    }"
                    x-init="startAutoSlide()"
                    @mouseenter="stopAutoSlide()"
                    @mouseleave="startAutoSlide()"
                    class="hidden md:block mt-10 relative"
                >
                    <div class="overflow-hidden">
                        <div
                            class="flex transition-transform duration-500 ease-in-out"
                            :style="`transform: translateX(-${activeIndex * 100}%)`"
                        >
                            @foreach ($desktopProductSlides as $slide)
                                <div wire:key="home-product-desktop-slide-{{ $loop->index }}" class="w-full flex-shrink-0 grid grid-cols-4 gap-5 px-1">
                                    @foreach ($slide as $product)
                                        <a href="{{ Route::has('products.detail') ? route('products.detail', $product->id) : '#' }}"
                                            wire:navigate
                                            wire:key="home-product-desktop-{{ $product->id }}"
                                            class="group rounded-tl-[25px] rounded-ee-[25px] border border-forest/10 overflow-hidden bg-white transition-all duration-300 hover:border-forest/30 hover:shadow-md"
                                        >
                                            <div class="aspect-square bg-gradient-to-br from-blush/50 via-blush/20 to-ivory flex items-center justify-center overflow-hidden">
                                                @if ($product->image)
                                                    <img
                                                        src="{{ \Storage::url($product->image) }}"
                                                        alt="{{ $product->name }}"
                                                        class="w-full h-full object-contain"
                                                        loading="lazy"
                                                    >
                                                @else
                                                    <svg viewBox="0 0 24 24" class="w-8 h-8 text-forest/25" fill="none" stroke="currentColor" stroke-width="1">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 3h6l1 3h3a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V7a1 1 0 011-1h3l1-3z" />
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="p-4">
                                                <p class="text-sm font-contax font-medium text-forest-dark leading-snug">{{ $product->name }}</p>
                                                <p class="mt-1 font-contax text-sm text-charcoal/50">
                                                    {{ $product->price ? 'Rp ' . number_format($product->price, 0, ',', '.') : 'Hubungi Kami' }}
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if ($desktopProductSlides->count() > 1)
                        <button
                            @click="prev(); restart()"
                            aria-label="Sebelumnya"
                            class="absolute top-1/2 -translate-y-1/2 -left-4 lg:-left-6 w-10 h-10 rounded-full bg-white border border-forest/10 shadow flex items-center justify-center text-forest-dark hover:bg-forest-dark hover:text-white transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button
                            @click="next(); restart()"
                            aria-label="Selanjutnya"
                            class="absolute top-1/2 -translate-y-1/2 -right-4 lg:-right-6 w-10 h-10 rounded-full bg-white border border-forest/10 shadow flex items-center justify-center text-forest-dark hover:bg-forest-dark hover:text-white transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        <div class="flex justify-center gap-2 mt-6">
                            @foreach ($desktopProductSlides as $slide)
                                <button
                                    @click="goTo({{ $loop->index }})"
                                    class="w-2 h-2 rounded-full transition-all duration-300"
                                    :class="activeIndex === {{ $loop->index }} ? 'bg-forest-dark w-8' : 'bg-forest/20'"
                                ></button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>
        @include('partials.landing.divider')
    @endif

    {{-- KENAPA MEMILIH KAMI --}}
    {{-- <section class="bg-forest-dark text-ivory py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-12">
                <div>
                    <span class="text-xs font-medium tracking-wide uppercase text-blush">Kenapa Kami</span>
                    <h2 class="mt-3 font-display text-3xl text-ivory leading-tight">
                        Ditangani langsung oleh dokter, bukan sekadar terapis.
                    </h2>
                </div>

                <div class="lg:col-span-2 grid sm:grid-cols-2 gap-8">
                    @foreach ([
                        ['title' => 'Dokter Berlisensi', 'desc' => 'Setiap treatment dan layanan medis ditangani oleh dokter dengan izin praktik resmi.'],
                        ['title' => 'Konsultasi Personal', 'desc' => 'Rekomendasi treatment disesuaikan dengan kondisi kulit dan riwayat kesehatanmu.'],
                        ['title' => 'Produk Teruji', 'desc' => 'Produk yang kami rekomendasikan sudah melalui kurasi dan uji keamanan.'],
                        ['title' => 'Lingkungan Nyaman', 'desc' => 'Ruang perawatan yang tenang, bersih, dan dirancang untuk kenyamananmu.'],
                    ] as $item)
                        <div>
                            <h3 class="font-contax text-lg text-ivory">{{ $item['title'] }}</h3>
                            <p class="mt-2 font-contax text-sm text-ivory/60 leading-relaxed">{{ $item['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-14 flex items-center gap-4 sm:gap-8 text-xs sm:text-sm text-ivory/70">
                <div>
                    <p class="font-contax text-lg sm:text-2xl text-ivory">10+</p>
                    <p class="font-contax whitespace-nowrap">Tahun melayani</p>
                </div>
                <div class="w-px h-8 sm:h-10 bg-ivory/20"></div>
                <div>
                    <p class="font-contax text-lg sm:text-2xl text-ivory">5.000+</p>
                    <p class="font-contax whitespace-nowrap">Pasien puas</p>
                </div>
                <div class="w-px h-8 sm:h-10 bg-ivory/20"></div>
                <div>
                    <p class="font-contax text-lg sm:text-2xl text-ivory">100%</p>
                    <p class="font-contax whitespace-nowrap">Dokter berlisensi</p>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- CUPLIKAN TESTIMONI --}}
    <section class="text-ivory py-20 lg:py-28 bg-gradient-to-b from-forest-dark/95 via-forest/95 to-forest/95"> 
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-end justify-between gap-4 flex-wrap">
                <div class="max-w-xl">
                    <span class="text-xs font-contax font-medium tracking-wide uppercase text-ivory">Testimoni</span>
                    <h2 class="mt-3 font-contax text-3xl sm:text-4xl text-ivory">
                        Kata mereka yang sudah merasakan
                    </h2>
                </div>
                
                <a href="{{ Route::has('testimonials') ? route('testimonials') : '#' }}"
                    wire:navigate
                    class="text-sm font-contax font-medium text-ivory border-b border-gold hover:text-gold transition-colors"
                >
                    Lihat Semua Testimoni →
                </a>
            </div>

            <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($this->featuredTestimonials as $testimonial)
                    <div
                        wire:key="home-testimonial-{{ $testimonial->id }}"
                        class="group flex h-full flex-col rounded-tl-[25px] rounded-ee-[25px] border border-ivory/10 bg-white p-7 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

                        {{-- Rating --}}
                        <div class="flex items-center gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg viewBox="0 0 20 20" class="w-4 h-4 {{ $i <= $testimonial->rating ? 'text-gold' : 'text-forest/10' }}" fill="currentColor">
                                    <path d="M10 1.5l2.6 5.27 5.82.85-4.21 4.1.99 5.79L10 14.9l-5.2 2.61.99-5.79-4.21-4.1 5.82-.85L10 1.5z" />
                                </svg>
                            @endfor
                        </div>

                        {{-- Testimoni --}}
                        <p class="mt-4 font-contax text-sm text-charcoal/70 leading-relaxed flex-1 line-clamp-2">
                            &ldquo;{{ $testimonial->message }}&rdquo;
                        </p>

                        {{-- Selengkapnya --}}
                        <a href="{{ route('testimonials.detail', $testimonial->id) }}"
                            wire:navigate
                            class="mt-3 self-start text-sm font-contax font-medium text-gold hover:text-forest transition-colors"
                        >
                            Selengkapnya →
                        </a>

                        {{-- Footer --}}
                        <div class="mt-5 pt-4 border-t border-forest/10">
                            <div class="flex items-center gap-3">
                                {{-- Avatar --}}
                                @if ($testimonial->avatar)
                                    <img
                                        src="{{ \Storage::url($testimonial->avatar) }}"
                                        alt="{{ $testimonial->name }}"
                                        class="h-11 w-11 rounded-full object-cover"
                                    >
                                @else
                                    <div class="flex h-11 w-11 items-center justify-center rounded-full bg-forest text-sm font-semibold text-ivory">
                                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                    </div>
                                @endif

                                <div class="min-w-0">
                                    <h4 class="truncate font-contax text-base text-forest-dark">
                                        {{ $testimonial->name }}
                                    </h4>

                                    @if ($testimonial->items_testimonials)
                                        <p class="text-xs sm:text-sm font-medium text-gold truncate">
                                            {{ $testimonial->items_testimonials }}
                                        </p>
                                    @else
                                        <p class="text-xs sm:text-sm text-charcoal/40">
                                            Pasien Klinik
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center">
                        <p class="text-ivory/60">Belum ada testimoni tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- CTA PENUTUP --}}
    <section class="py-20 lg:py-28">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <h2 class="font-contax text-3xl sm:text-4xl text-forest-dark">
                Siap untuk konsultasi pertamamu?
            </h2>
            <p class="mt-4 font-contax text-charcoal/60">
                Tim kami siap membantu menentukan treatment yang paling sesuai untukmu — tanpa paksaan, tanpa buru-buru.
            </p>
            
            <a href="https://wa.me/6285822810149"
                target="_blank"
                rel="noopener"
                class="mt-8 inline-flex items-center justify-center gap-2 rounded-full bg-forest px-8 py-4 text-sm font-contax font-medium text-ivory shadow-sm transition-all duration-300 hover:bg-forest-dark hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gold"
            >
                Hubungi Kami di WhatsApp
            </a>
        </div>
    </section>
</div>