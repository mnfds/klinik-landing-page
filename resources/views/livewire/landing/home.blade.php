<div>
    {{-- HERO CAROUSEL --}}
    <section
        x-data="{
            active: 0,
            slides: 3,
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
        {{-- SLIDE 1 --}}
        <div
            x-show="active === 0"
            x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0"
        >
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/banner/services.png') }}')"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-black/10 sm:bg-gradient-to-r sm:from-ivory/95 sm:via-ivory/60 sm:to-transparent"></div>

            {{-- WRAPPER: kasih clearance navbar + boleh scroll internal kalau konten kepanjangan --}}
            <div class="relative h-full overflow-y-auto pt-20 sm:pt-24 pb-6">
                <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 h-full flex items-center">
                    <div class="max-w-2xl w-full">
                        <span class="inline-flex items-center gap-2 text-[11px] sm:text-xs font-contax font-medium tracking-wide uppercase text-ivory sm:text-forest/70 bg-forest/40 sm:bg-blush/40 rounded-full px-3.5 py-1.5">
                            Klinik Kecantikan &amp; Medis
                        </span>

                        <h1 class="mt-4 sm:mt-6 font-contax font-bold text-2xl xs:text-3xl sm:text-5xl lg:text-6xl leading-[1.15] sm:leading-[1.1] text-ivory sm:text-forest-dark">
                            Merawat kulitmu, dengan ketenangan yang tepat.
                        </h1>

                        <p class="mt-3 sm:mt-6 font-contax text-sm sm:text-lg text-ivory/80 sm:text-charcoal/70 leading-relaxed max-w-lg">
                            Kami memadukan perawatan estetika dan layanan medis dalam satu tempat —
                            ditangani langsung oleh dokter berpengalaman, dengan pendekatan yang personal untuk setiap jenis kulit.
                        </p>

                        <div class="mt-5 sm:mt-10 flex flex-col sm:flex-row gap-3 sm:gap-4">
                            <a href="https://wa.me/6285822810149"
                                target="_blank"
                                rel="noopener"
                                class="inline-flex items-center justify-center gap-2 rounded-full bg-forest px-6 py-3 sm:py-3.5 text-sm font-contax font-medium text-ivory shadow-sm transition-all duration-300 hover:bg-forest-dark hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gold"
                            >
                                Booking via WhatsApp
                            </a>

                            <a href="{{ Route::has('services') ? route('services') : '#' }}"
                                wire:navigate
                                class="inline-flex items-center justify-center gap-2 rounded-full border border-ivory/40 sm:border-forest/20 px-6 py-3 sm:py-3.5 text-sm font-contax font-medium text-ivory sm:text-forest-dark transition-all duration-300 hover:border-forest hover:bg-white/10 sm:hover:bg-forest/5"
                            >
                                Lihat Layanan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SLIDE 2 --}}
        <div
            x-show="active === 1"
            x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0"
            >
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/banner/products.png') }}')"></div>

            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-black/10 sm:bg-gradient-to-r sm:from-ivory/95 sm:via-ivory/60 sm:to-transparent"></div>

            <div class="relative h-full max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 flex items-end sm:items-center pb-14 sm:pb-0">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center gap-2 text-[11px] sm:text-xs font-contax font-medium tracking-wide uppercase text-ivory sm:text-forest/70 bg-forest/40 sm:bg-blush/40 rounded-full px-3.5 py-1.5">
                        Konsultasi Gratis
                    </span>

                    <h1 class="mt-4 sm:mt-6 font-contax font-bold text-3xl sm:text-5xl lg:text-6xl leading-[1.15] sm:leading-[1.1] text-ivory sm:text-forest-dark">
                        Konsultasi sebelum treatment pertamamu.
                    </h1>

                    <p class="mt-3 sm:mt-6 font-contax text-sm sm:text-lg text-ivory/80 sm:text-charcoal/70 leading-relaxed max-w-lg">
                        Dokter kami akan membantu menentukan perawatan yang paling sesuai dengan kondisi kulitmu, tanpa biaya konsultasi.
                    </p>

                    <div class="mt-6 sm:mt-10">
                        <a href="https://wa.me/6285822810149"
                            target="_blank"
                            rel="noopener"
                            class="inline-flex items-center justify-center gap-2 rounded-full bg-forest px-6 py-3 sm:py-3.5 text-sm font-contax font-medium text-ivory shadow-sm transition-all duration-300 hover:bg-forest-dark hover:shadow-md"
                        >
                            Booking Konsultasi
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- SLIDE 3 --}}
        <div
            x-show="active === 2"
            x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0"
            >
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/banner/promo.png') }}')"></div>

            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-black/10 sm:bg-gradient-to-r sm:from-ivory/95 sm:via-ivory/60 sm:to-transparent"></div>

            <div class="relative h-full max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 flex items-end sm:items-center pb-14 sm:pb-0">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center gap-2 text-[11px] sm:text-xs font-contax font-medium tracking-wide uppercase text-ivory sm:text-forest/70 bg-forest/40 sm:bg-blush/40 rounded-full px-3.5 py-1.5">
                        Dokter Berlisensi
                    </span>

                    <h1 class="mt-4 sm:mt-6 font-contax font-bold text-3xl sm:text-5xl lg:text-6xl leading-[1.15] sm:leading-[1.1] text-ivory sm:text-forest-dark">
                        Ditangani langsung oleh tenaga medis profesional.
                    </h1>

                    <p class="mt-3 sm:mt-6 font-contax text-sm sm:text-lg text-ivory/80 sm:text-charcoal/70 leading-relaxed max-w-lg">
                        Setiap prosedur dilakukan oleh dokter berpengalaman dengan standar medis yang terjamin.
                    </p>

                    <div class="mt-6 sm:mt-10">
                        <a href="{{ Route::has('services') ? route('services') : '#' }}"
                            wire:navigate
                            class="inline-flex items-center justify-center gap-2 rounded-full border border-ivory/40 sm:border-forest/20 px-6 py-3 sm:py-3.5 text-sm font-contax font-medium text-ivory sm:text-forest-dark transition-all duration-300 hover:border-forest hover:bg-white/10 sm:hover:bg-forest/5"
                        >
                            Lihat Layanan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- DOT INDICATORS --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex items-center gap-3 z-10">
            <template x-for="i in slides" :key="i">
                <button
                    @click="goTo(i - 1)"
                    :class="active === i - 1 ? 'bg-ivory w-8' : 'bg-ivory/30 w-2.5 hover:bg-ivory/50'"
                    class="h-2.5 rounded-full transition-all duration-300"
                    :aria-label="'Slide ' + i"
                ></button>
            </template>
        </div>
        {{-- OPTIONAL: PREV/NEXT ARROWS --}}
    </section>

    @include('partials.landing.divider')

    {{-- PROMO AKTIF --}}
    @if (count($this->promos) > 0)
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

                <div
                    x-data="{
                        activeIndex: 0,
                        total: {{ count($this->promos) }},
                        autoSlide: null,
                        next() {
                            this.activeIndex = (this.activeIndex + 1) % this.total;
                        },
                        startAutoSlide() {
                            this.autoSlide = setInterval(() => this.next(), 4000);
                        },
                        stopAutoSlide() {
                            clearInterval(this.autoSlide);
                        }
                    }"
                    x-init="startAutoSlide()"
                    @mouseenter="stopAutoSlide()"
                    @mouseleave="startAutoSlide()"
                    class="mt-10 relative max-w-md mx-auto"
                >
                    {{-- Track --}}
                    <div class="overflow-hidden">
                        <div
                            class="flex transition-transform duration-500 ease-in-out"
                            :style="`transform: translateX(-${activeIndex * 100}%)`"
                        >
                            @foreach ($this->promos as $promo)
                                <div wire:key="home-promo-{{ $loop->index }}" class="w-full flex-shrink-0 px-1">
                                    <div class="rounded-tl-[25px] rounded-ee-[25px] bg-white border border-forest/10 overflow-hidden">
                                        @if (!empty($promo['image']))
                                            <img
                                                src="{{ $promo['image'] }}"
                                                alt="{{ $promo['title'] }}"
                                                class="w-full h-auto object-contain block"
                                            >
                                        @endif

                                        <div class="p-7">
                                            <h3 class="font-contax text-lg text-forest-dark">{{ $promo['title'] }}</h3>
                                            <p class="mt-2 font-contax text-sm text-charcoal/60 leading-relaxed">{{ $promo['description'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Dots --}}
                    <div class="flex justify-center gap-2 mt-5">
                        @foreach ($this->promos as $promo)
                            <button
                                @click="activeIndex = {{ $loop->index }}; stopAutoSlide(); startAutoSlide()"
                                class="w-2 h-2 rounded-full transition-colors"
                                :class="activeIndex === {{ $loop->index }} ? 'bg-forest-dark' : 'bg-forest/20'"
                            ></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        @include('partials.landing.divider')
    @endif

    {{-- LAYANAN UNGGULAN --}}
    <section class="bg-ivory py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-xl">
                <span class="text-xs font-contax font-medium tracking-wide uppercase text-gold">Layanan Kami</span>
                <h2 class="mt-3 font-contax text-3xl sm:text-4xl text-forest-dark">
                    Dirancang untuk setiap kebutuhan kulit dan tubuhmu
                </h2>
            </div>

            <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ([
                    ['title' => 'Treatment Estetika', 'desc' => 'Facial, laser, dan perawatan kecantikan lain untuk kulit sehat dan glowing.'],
                    ['title' => 'Layanan Medis', 'desc' => 'Konsultasi dan penanganan medis non-tindakan estetika oleh dokter berpengalaman.'],
                    ['title' => 'Produk Perawatan', 'desc' => 'Rangkaian skincare pilihan yang bisa kamu bawa pulang, konsultasikan dulu via WhatsApp.'],
                ] as $item)
                    <div class="group rounded-tl-[25px] rounded-ee-[25px] border border-forest/10 p-8 transition-all duration-300 hover:border-forest/30 hover:shadow-sm">
                        <span class="flex items-center justify-center w-11 h-11 rounded-full bg-blush/40 text-forest transition-colors duration-300 group-hover:bg-blush">
                            <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 3c-3 3-5 6-5 9a5 5 0 0010 0c0-3-2-6-5-9z" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <h3 class="mt-6 font-contax text-xl text-forest-dark">{{ $item['title'] }}</h3>
                        <p class="mt-2 font-contax text-sm text-charcoal/60 leading-relaxed">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.landing.divider')

    {{-- CUPLIKAN PRODUK --}}
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

            <div class="mt-10 grid grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach ($this->featuredProducts as $product)
                    
                    <a href="{{ Route::has('products.detail') ? route('products.detail', $product['slug']) : '#' }}"
                        wire:navigate
                        wire:key="home-product-{{ $loop->index }}"
                        class="group rounded-tl-[25px] rounded-ee-[25px] border border-forest/10 overflow-hidden bg-white transition-all duration-300 hover:border-forest/30 hover:shadow-md"
                    >
                        <div class="aspect-square bg-gradient-to-br from-blush/50 via-blush/20 to-ivory flex items-center justify-center">
                            <svg viewBox="0 0 24 24" class="w-8 h-8 text-forest/25" fill="none" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 3h6l1 3h3a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V7a1 1 0 011-1h3l1-3z" />
                            </svg>
                        </div>
                        <div class="p-4">
                            <p class="text-sm font-contax font-medium text-forest-dark leading-snug">{{ $product['name'] }}</p>
                            <p class="mt-1 font-contax text-sm text-charcoal/50">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.landing.divider')

    {{-- KENAPA MEMILIH KAMI --}}
    <section class="bg-forest-dark text-ivory py-20 lg:py-28">
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

            {{-- Trust strip --}}
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
    </section>

    {{-- CUPLIKAN TESTIMONI --}}
    <section class="bg-ivory py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-end justify-between gap-4 flex-wrap">
                <div class="max-w-xl">
                    <span class="text-xs font-contax font-medium tracking-wide uppercase text-gold">Testimoni</span>
                    <h2 class="mt-3 font-contax text-3xl sm:text-4xl text-forest-dark">
                        Kata mereka yang sudah merasakan
                    </h2>
                </div>
                
                <a href="{{ Route::has('testimonials') ? route('testimonials') : '#' }}"
                    wire:navigate
                    class="text-sm font-contax font-medium text-forest-dark border-b border-gold hover:text-forest transition-colors"
                >
                    Lihat Semua Testimoni →
                </a>
            </div>

            <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($this->featuredTestimonials as $testimonial)
                    <div wire:key="home-testimonial-{{ $loop->index }}" class="rounded-tl-[25px] rounded-ee-[25px] border border-forest/10 bg-white p-7 flex flex-col">
                        <div class="flex items-center gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg viewBox="0 0 20 20" class="w-4 h-4 {{ $i <= $testimonial['rating'] ? 'text-gold' : 'text-forest/10' }}" fill="currentColor">
                                    <path d="M10 1.5l2.6 5.27 5.82.85-4.21 4.1.99 5.79L10 14.9l-5.2 2.61.99-5.79-4.21-4.1 5.82-.85L10 1.5z" />
                                </svg>
                            @endfor
                        </div>
                        <p class="mt-4 font-contax text-sm text-charcoal/70 leading-relaxed flex-1">
                            &ldquo;{{ $testimonial['message'] }}&rdquo;
                        </p>
                        <p class="mt-5 pt-4 border-t border-forest/10 font-contax text-base text-forest-dark">
                            {{ $testimonial['name'] }}
                        </p>
                    </div>
                @endforeach
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