<div>
    {{-- HEADER --}}
    <x-page-header
        label="Testimoni"
        title="Cerita nyata dari pasien kami"
        subtitle="Pengalaman langsung dari mereka yang sudah merasakan perawatan di klinik kami."
        :image-desktop="$this->banner && $this->banner->image_desktop ? \Storage::url($this->banner->image_desktop) : asset('images/banner/testimonials.png')"
        :image-mobile="$this->banner && $this->banner->image_mobile ? \Storage::url($this->banner->image_mobile) : asset('images/banner/testimonials.png')"
    />

    @include('partials.landing.divider')

    {{-- GRID --}}
    <section class="bg-ivory py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 lg:gap-6">
                @forelse ($this->testimonialsList as $testimonial)
                    <div
                        wire:key="testimonial-{{ $testimonial->id }}"
                        class="group flex h-full flex-col rounded-tl-[25px] rounded-ee-[25px] border border-forest/10 bg-white p-5 lg:p-6 transition-all duration-300 hover:-translate-y-1 hover:border-forest/20 hover:shadow-lg">

                        {{-- Rating --}}
                        <div class="flex items-center gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg
                                    viewBox="0 0 20 20"
                                    class="w-4 h-4 sm:w-5 sm:h-5 {{ $i <= $testimonial->rating ? 'text-gold' : 'text-forest/10' }}"
                                    fill="currentColor">
                                    <path d="M10 1.5l2.6 5.27 5.82.85-4.21 4.1.99 5.79L10 14.9l-5.2 2.61.99-5.79-4.21-4.1 5.82-.85L10 1.5z"/>
                                </svg>
                            @endfor
                        </div>

                        {{-- Testimoni --}}
                        <p class="mt-4 flex-1 text-xs sm:text-sm leading-6 text-charcoal/70 line-clamp-2">
                            &ldquo;{{ $testimonial->message }}&rdquo;
                        </p>

                        {{-- Selengkapnya --}}
                        <a href="{{ route('testimonials.detail', $testimonial->id) }}"
                            wire:navigate
                            class="mt-3 self-start text-xs sm:text-sm font-medium text-gold hover:text-forest transition-colors"
                        >
                            Selengkapnya →
                        </a>
                        {{-- Footer --}}
                        <div class="mt-5 border-t border-forest/10 pt-5">

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
                                    <h4 class="truncate font-display text-sm sm:text-base text-forest-dark">
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
                        <p class="text-charcoal/50">
                            Belum ada testimoni tersedia.
                        </p>
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

            <a href="https://wa.me/6285822810149"
                target="_blank"
                rel="noopener"
                class="mt-8 inline-flex items-center justify-center gap-2 rounded-full bg-forest px-8 py-4 text-sm font-medium text-ivory shadow-sm transition-all duration-300 hover:bg-forest-dark hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gold"
            >
                Hubungi Kami di WhatsApp
            </a>
        </div>
    </section>
</div>