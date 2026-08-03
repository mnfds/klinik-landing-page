<div>
    {{-- HEADER --}}
    <section class="bg-forest-dark text-ivory py-20 lg:py-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <span class="text-xs font-medium tracking-wide uppercase text-blush">Testimoni</span>
            <h1 class="mt-3 font-display text-4xl sm:text-5xl leading-tight max-w-2xl">
                Cerita nyata dari pasien kami
            </h1>
            <p class="mt-4 text-ivory/70 max-w-xl">
                Pengalaman langsung dari mereka yang sudah merasakan perawatan di klinik kami.
            </p>
        </div>
    </section>

    @include('partials.landing.divider')

    {{-- GRID --}}
    <section class="bg-ivory py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($this->testimonialsList as $testimonial)
                    <div wire:key="testimonial-{{ $loop->index }}" class="rounded-2xl border border-forest/10 bg-white p-7 flex flex-col">

                        {{-- Rating --}}
                        <div class="flex items-center gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg
                                    viewBox="0 0 20 20"
                                    class="w-4 h-4 {{ $i <= $testimonial['rating'] ? 'text-gold' : 'text-forest/10' }}"
                                    fill="currentColor"
                                >
                                    <path d="M10 1.5l2.6 5.27 5.82.85-4.21 4.1.99 5.79L10 14.9l-5.2 2.61.99-5.79-4.21-4.1 5.82-.85L10 1.5z" />
                                </svg>
                            @endfor
                        </div>

                        {{-- Message --}}
                        <p class="mt-4 text-sm text-charcoal/70 leading-relaxed flex-1">
                            &ldquo;{{ $testimonial['message'] }}&rdquo;
                        </p>

                        {{-- Footer --}}
                        <div class="mt-6 pt-5 border-t border-forest/10">
                            <p class="font-display text-base text-forest-dark">{{ $testimonial['name'] }}</p>

                            @if ($testimonial['service_name'])
                                <span class="mt-1 inline-block text-xs text-gold font-medium">
                                    {{ $testimonial['service_name'] }}
                                </span>
                            @else
                                <span class="mt-1 inline-block text-xs text-charcoal/40">
                                    Pasien Klinik
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <p class="text-charcoal/50">Belum ada testimoni tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-16 lg:py-20 border-t border-forest/10">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <h2 class="font-display text-3xl sm:text-4xl text-forest-dark">
                Ingin jadi bagian dari cerita berikutnya?
            </h2>
            <p class="mt-4 text-charcoal/60">
                Konsultasikan kebutuhan perawatanmu dengan tim kami sekarang.
            </p>
            
            <a href="https://wa.me/6280000000000"
                target="_blank"
                rel="noopener"
                class="mt-8 inline-flex items-center justify-center gap-2 rounded-full bg-forest px-8 py-4 text-sm font-medium text-ivory shadow-sm transition-all duration-300 hover:bg-forest-dark hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gold"
            >
                Hubungi Kami di WhatsApp
            </a>
        </div>
    </section>
</div>