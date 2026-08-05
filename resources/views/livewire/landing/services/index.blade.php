<div>
    {{-- HEADER --}}
    <x-page-header
        label="Layanan Kami"
        title="Treatment estetika dan layanan medis dalam satu tempat"
        subtitle="Setiap layanan ditangani langsung oleh dokter dan tenaga profesional berpengalaman."
        image="{{ asset('images/banner/services.png') }}"
    />

    @include('partials.landing.divider')

    {{-- FILTER + GRID --}}
    <section class="bg-ivory py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- Filter Tabs --}}
            <div class="flex flex-wrap gap-3">
                @foreach ([
                    'all' => 'Semua Layanan',
                    'treatment' => 'Treatment Estetika',
                    'medical' => 'Layanan Medis',
                ] as $key => $label)
                    <button
                        wire:click="setType('{{ $key }}')"
                        class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gold
                            {{ $activeType === $key
                                ? 'bg-forest text-ivory shadow-sm'
                                : 'bg-transparent text-charcoal/70 border border-forest/15 hover:border-forest/40' }}"
                    >
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            {{-- Grid --}}
            <div class="mt-10 grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6" wire:key="services-grid-{{ $activeType }}">
                @forelse ($this->filteredServices as $service)
                    <div wire:key="service-{{ $loop->index }}" class="group h-full flex flex-col rounded-tl-[25px] rounded-ee-[25px] border border-forest/10 overflow-hidden bg-white transition-all duration-300 hover:border-forest/30 hover:shadow-md">
                        {{-- Image --}}
                        <div class="aspect-square bg-gradient-to-br from-blush/50 via-blush/20 to-ivory flex items-center justify-center overflow-hidden">
                            @if (!empty($service['box']))
                                <img
                                    src="{{ $service['box'] }}"
                                    alt="{{ $service['name'] }}"
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
                            <span class="text-[11px] font-contax font-medium tracking-wide uppercase text-gold">
                                {{ $service['type'] === 'treatment' ? 'Treatment Estetika' : 'Layanan Medis' }}
                            </span>

                            <h3 class="mt-2 font-contax text-base lg:text-lg text-forest-dark">
                                {{ $service['name'] }}
                            </h3>

                            <p class="mt-2 font-contax text-sm text-charcoal/60 leading-relaxed line-clamp-2">
                                {{ $service['description'] }}
                            </p>
                            {{-- Grup price + button, selalu nempel di bawah & berdekatan --}}
                            <div class="mt-auto pt-4">
                                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                    @if ($service['youtube_link'])
                                        <a href="{{ $service['youtube_link'] }}"
                                            target="_blank"
                                            rel="noopener"
                                            class="order-1 sm:order-2 inline-flex items-center gap-1 text-xs sm:text-sm text-charcoal/50 hover:text-forest transition-colors self-start sm:self-auto"
                                        >
                                            <svg viewBox="0 0 24 24" class="w-4 h-4 flex-shrink-0" fill="currentColor">
                                                <path d="M10 8l6 4-6 4V8z"/>
                                                <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                            </svg>
                                            <span>Video</span>
                                        </a>
                                    @endif
                                    <span class="order-2 sm:order-1 font-contax text-lg sm:text-xl text-forest-dark">
                                        Rp {{ number_format($service['price'], 0, ',', '.') }}
                                    </span>
                                </div>

                                <div class="mt-3 flex flex-col gap-2">

                                    <a href="{{ route('services.detail', $service['slug']) }}"
                                        wire:navigate
                                        class="block text-center rounded-full bg-forest py-2 lg:py-2.5 text-xs lg:text-sm font-contax font-medium text-ivory transition-all duration-300 hover:bg-forest-dark"
                                    >
                                        Lihat Detail
                                    </a>

                                    <a href="https://wa.me/6285822810149?text={{ urlencode('Halo, saya ingin tanya tentang layanan ' . $service['name']) }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="block text-center rounded-full border border-forest/20 py-2 lg:py-2.5 text-xs lg:text-sm font-contax font-medium text-forest-dark transition-all duration-300 hover:bg-[#25D366] hover:text-white hover:border-[#1f8f48]"
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
                        <p class="text-charcoal/50">Belum ada layanan untuk kategori ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>