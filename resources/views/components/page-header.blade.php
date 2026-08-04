@props([
    'badge' => null,
    'description' => null,
    'image' => null,
])

<section class="relative min-h-screen flex items-center overflow-hidden bg-forest-dark text-ivory">
    {{-- Pattern background - motif botanical, senada dengan logo --}}
    <svg class="absolute inset-0 w-full h-full opacity-[0.06]" aria-hidden="true" preserveAspectRatio="xMidYMid slice">
        <defs>
            <pattern id="page-header-pattern" x="0" y="0" width="72" height="72" patternUnits="userSpaceOnUse">
                <path
                    d="M36 20c-6 6-10 12-10 18a10 10 0 0020 0c0-6-4-12-10-18z"
                    fill="none"
                    stroke="#FBF7F1"
                    stroke-width="1.5"
                />
            </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#page-header-pattern)" />
    </svg>

    {{-- Gradient overlay untuk kedalaman, supaya teks tetap kontras di atas pattern --}}
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-forest-dark/30 to-forest-dark/80 pointer-events-none"></div>

    <div class="relative w-full max-w-7xl mx-auto px-6 lg:px-8 py-24 lg:py-20">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            {{-- Teks: di mobile tampil PERTAMA (atas), di desktop pindah ke KANAN --}}
            <div class="order-1 lg:order-2 text-center lg:text-left">
                @if ($badge)
                    <span class="inline-block text-xs font-medium tracking-wide uppercase text-blush">
                        {{ $badge }}
                    </span>
                @endif

                <h1 class="mt-3 font-display text-4xl sm:text-5xl leading-tight">
                    {{ $slot }}
                </h1>

                @if ($description)
                    <p class="mt-4 text-ivory/70 max-w-xl mx-auto lg:mx-0">
                        {{ $description }}
                    </p>
                @endif
            </div>

            {{-- Foto Model: di mobile tampil KEDUA (bawah), di desktop pindah ke KIRI --}}
            <div class="order-2 lg:order-1">
                <div class="relative aspect-[4/5] max-w-sm sm:max-w-md mx-auto lg:max-w-none rounded-[2rem] overflow-hidden border border-ivory/10 bg-gradient-to-br from-blush/25 via-blush/10 to-transparent shadow-2xl">
                    @if ($image)
                        <img src="{{ $image }}" alt="" class="w-full h-full object-cover">
                    @else
                        {{-- Placeholder - ganti prop :image dengan foto model asli --}}
                        <div class="w-full h-full flex items-center justify-center">
                            <svg viewBox="0 0 24 24" class="w-16 h-16 text-ivory/20" fill="none" stroke="currentColor" stroke-width="1">
                                <circle cx="12" cy="8" r="4" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>