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
            <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 gap-6" wire:key="services-grid-{{ $activeType }}">
                @forelse ($this->filteredServices as $service)
                    <div wire:key="service-{{ $loop->index }}" class="group rounded-2xl border border-forest/10 overflow-hidden bg-white transition-all duration-300 hover:border-forest/30 hover:shadow-md">
                        {{-- Image placeholder --}}
                        <div class="aspect-[4/3] bg-gradient-to-br from-blush/50 via-blush/20 to-ivory flex items-center justify-center">
                            <svg viewBox="0 0 24 24" class="w-10 h-10 text-forest/25" fill="none" stroke="currentColor" stroke-width="1">
                                <path d="M12 3c-3 3-5 6-5 9a5 5 0 0010 0c0-3-2-6-5-9z" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>

                        <div class="p-6">
                            <span class="text-[11px] font-medium tracking-wide uppercase text-gold">
                                {{ $service['type'] === 'treatment' ? 'Treatment Estetika' : 'Layanan Medis' }}
                            </span>

                            <h3 class="mt-2 font-display text-xl text-forest-dark">
                                {{ $service['name'] }}
                            </h3>

                            <p class="mt-2 text-sm text-charcoal/60 leading-relaxed">
                                {{ $service['description'] }}
                            </p>

                            <div class="mt-5 flex items-center justify-between">
                                <span class="font-display text-lg text-forest-dark">
                                    Rp {{ number_format($service['price'], 0, ',', '.') }}
                                </span>

                                @if ($service['youtube_link'])
                                    
                                    <a href="{{ $service['youtube_link'] }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="text-xs text-charcoal/50 hover:text-forest transition-colors flex items-center gap-1"
                                    >
                                        <svg viewBox="0 0 24 24" class="w-4 h-4" fill="currentColor">
                                            <path d="M10 8l6 4-6 4V8z"/><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                        </svg>
                                        Video
                                    </a>
                                @endif
                            </div>
                            <div class="mt-5 flex flex-col gap-2">
                                
                                <a href="{{ route('services.detail', $service['slug']) }}"
                                    wire:navigate
                                    class="block text-center rounded-full bg-forest py-2.5 text-sm font-medium text-ivory transition-all duration-300 hover:bg-forest-dark"
                                >
                                    Lihat Detail
                                </a>
                                
                                <a href="https://wa.me/6285822810149?text={{ urlencode('Halo, saya ingin tanya tentang layanan ' . $service['name']) }}"
                                    target="_blank"
                                    rel="noopener"
                                    class="block text-center rounded-full border border-forest/20 py-2.5 text-sm font-medium text-forest-dark transition-all duration-300 hover:bg-forest hover:text-ivory hover:border-forest"
                                >
                                    Tanya via WhatsApp
                                </a>
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