@props([
    'label' => null,
    'title',
    'subtitle' => null,
    'image',
    'height' => 'h-screen',
])

<section class="relative {{ $height }} overflow-hidden">
    {{-- Banner image --}}
    <img
        src="{{ $image }}"
        alt="{{ $title }}"
        class="absolute inset-0 w-full h-full object-cover"
        loading="eager"
    >

    {{-- Overlay gradient supaya teks tetap kebaca --}}
    <div class="absolute inset-0 bg-gradient-to-t from-forest-dark/70 via-forest-dark/20 to-forest-dark/0"></div>

    {{-- Content --}}
    <div class="relative h-full max-w-7xl mx-auto px-6 lg:px-8 flex flex-col justify-end pb-10 lg:pb-14">
        @if($label)
            <span class="text-xs font-medium tracking-wide uppercase text-blush">{{ $label }}</span>
        @endif

        <h1 class="mt-3 font-display text-4xl sm:text-5xl leading-tight max-w-2xl text-ivory">
            {{ $title }}
        </h1>

        @if($subtitle)
            <p class="mt-4 text-ivory/70 max-w-xl">
                {{ $subtitle }}
            </p>
        @endif

        {{ $slot ?? '' }}
    </div>
</section>