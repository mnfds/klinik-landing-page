<div>
    {{-- BREADCRUMB --}}
    <div class="bg-ivory border-b border-forest/10 pt-[70px] lg:pt-[110px]">
        <div class="max-w-5xl mx-auto px-6 lg:px-8 py-4 flex justify-end">
            <a href="{{ route('services') }}" wire:navigate class="text-sm font-contax text-charcoal/60 hover:text-forest transition-colors inline-flex items-center gap-1">
                <svg viewBox="0 0 24 24" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Layanan
            </a>
        </div>
    </div>

    {{-- DETAIL --}}
    <section class="py-16 lg:py-20">
        <div class="max-w-5xl mx-auto px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-start">

            {{-- Image --}}
            <div class="aspect-[4/3] rounded-3xl bg-gradient-to-br from-blush/50 via-blush/20 to-ivory border border-forest/10 flex items-center justify-center overflow-hidden">
                @if ($service->image)
                    <img
                        src="{{ \Storage::url($service->image) }}"
                        alt="{{ $service->name }}"
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
                <span class="text-xs font-contax font-medium tracking-wide uppercase text-gold">
                    {{ $service->type === 'treatment' ? 'Treatment Estetika' : 'Layanan Medis' }}
                </span>

                <h1 class="mt-3 font-contax text-3xl sm:text-4xl text-forest-dark leading-tight">
                    {{ $service->name }}
                </h1>

                <p class="mt-3 font-contax text-2xl text-forest">
                    {{ $service->price ? 'Rp ' . number_format($service->price, 0, ',', '.') : 'Hubungi Kami' }}
                </p>

                <p class="mt-6 font-contax text-charcoal/70 leading-relaxed">
                    {{ $service->description }}
                </p>

                @if ($service->youtube_link)
                    <a href="{{ $service->youtube_link }}"
                        target="_blank"
                        rel="noopener"
                        class="mt-6 inline-flex items-center gap-2 font-contax text-sm text-forest-dark border border-forest/20 rounded-full px-5 py-2.5 hover:bg-forest/5 transition-colors"
                    >
                        <svg viewBox="0 0 24 24" class="w-4 h-4" fill="currentColor">
                            <path d="M10 8l6 4-6 4V8z"/><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="1.5"/>
                        </svg>
                        Tonton Video Penjelasan
                    </a>
                @endif

                <div class="mt-8 flex flex-col sm:flex-row gap-3">

                    <a href="https://wa.me/6285822810149?text={{ urlencode('Halo, saya ingin booking layanan ' . $service->name) }}"
                        target="_blank"
                        rel="noopener"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-forest px-6 py-3.5 text-sm font-contax font-medium text-ivory shadow-sm transition-all duration-300 hover:bg-forest-dark hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gold"
                    >
                        Booking via WhatsApp
                    </a>

                    <a href="{{ route('services') }}"
                        wire:navigate
                        class="inline-flex items-center justify-center gap-2 rounded-full border border-forest/20 px-6 py-3.5 text-sm font-contax font-medium text-forest-dark transition-all duration-300 hover:border-forest hover:bg-forest/5"
                    >
                        Lihat Layanan Lain
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>