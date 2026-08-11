<div>
    {{-- BREADCRUMB --}}
    <div class="bg-ivory border-b border-forest/10 pt-[70px] lg:pt-[110px]">
        <div class="max-w-5xl mx-auto px-6 lg:px-8 py-4 flex justify-end">
            <a href="{{ route('testimonials') }}" wire:navigate class="text-sm font-contax text-charcoal/60 hover:text-forest transition-colors inline-flex items-center gap-1">
                <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Testimonials
            </a>
        </div>
    </div>

    {{-- DETAIL --}}
    <section class="py-16 lg:py-20">
        <div class="max-w-5xl mx-auto px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-start">

            {{-- Image --}}
            <div class="aspect-square rounded-3xl bg-gradient-to-br from-blush/50 via-blush/20 to-ivory border border-forest/10 flex items-center justify-center overflow-hidden">
                @if ($testimonial->photo)
                    <img
                        src="{{ \Storage::url($testimonial->photo) }}"
                        alt="{{ $testimonial->name }}"
                        class="w-full h-full object-contain"
                    >
                @else
                    <svg viewBox="0 0 24 24" class="w-16 h-16 text-forest/25" fill="none" stroke="currentColor" stroke-width="1">
                        <path d="M12 3c-3 3-5 6-5 9a5 5 0 0010 0c0-3-2-6-5-9z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                @endif
            </div>

            {{-- Content --}}
            <div>
                <div class="flex items-center gap-3">
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

                    <div>
                        <span class="text-xs font-contax font-medium tracking-wide uppercase text-gold">
                            Testimonial dari
                        </span>
                        <h1 class="font-contax text-xl sm:text-2xl text-forest-dark leading-tight">
                            {{ $testimonial->name }}
                        </h1>
                    </div>
                </div>

                {{-- Rating --}}
                <div class="mt-4 flex items-center gap-1">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg
                            viewBox="0 0 20 20"
                            class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-gold' : 'text-forest/10' }}"
                            fill="currentColor">
                            <path d="M10 1.5l2.6 5.27 5.82.85-4.21 4.1.99 5.79L10 14.9l-5.2 2.61.99-5.79-4.21-4.1 5.82-.85L10 1.5z"/>
                        </svg>
                    @endfor
                </div>

                <p class="mt-6 font-contax text-2xl text-forest leading-snug">
                    "{{ $testimonial->message }}"
                </p>

                @if ($testimonial->items_testimonials)
                    <p class="mt-6 font-contax text-charcoal/70 leading-relaxed">
                        Mengenai: <span class="font-medium text-forest-dark">{{ $testimonial->items_testimonials }}</span>
                    </p>
                @endif

                @if ($testimonial->youtube_link)
                    <a href="{{ $testimonial->youtube_link }}"
                        target="_blank"
                        rel="noopener"
                        class="mt-6 inline-flex items-center gap-2 text-sm font-contax text-forest-dark border border-forest/20 rounded-full px-5 py-2.5 hover:bg-forest/5 transition-colors"
                    >
                        <svg viewBox="0 0 24 24" class="w-4 h-4" fill="currentColor">
                            <path d="M10 8l6 4-6 4V8z"/><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="1.5"/>
                        </svg>
                        Tonton Video Penjelasan
                    </a>
                @endif

                <div class="mt-8">
                    <a href="{{ route('testimonials') }}"
                        wire:navigate
                        class="inline-flex items-center justify-center gap-2 rounded-full border border-forest/20 px-6 py-3.5 text-sm font-contax font-medium text-forest-dark transition-all duration-300 hover:border-forest hover:bg-forest/5"
                    >
                        Lihat Testimoni Lain
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>