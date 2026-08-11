@props([
    'label' => null,
    'title',
    'subtitle' => null,
    'image' => null,
    'imageMobile' => null,
    'imageDesktop' => null,
    'height' => 'h-screen',
])

@php
    // Fallback: kalau imageMobile/imageDesktop tidak diisi, pakai $image untuk keduanya
    $desktopSrc = $imageDesktop ?? $image;
    $mobileSrc = $imageMobile ?? $image;
@endphp

<section class="relative {{ $height }} overflow-hidden">
    {{-- Banner image: mobile --}}
    @if ($mobileSrc)
        <img
            src="{{ $mobileSrc }}"
            alt="{{ $title }}"
            class="absolute inset-0 w-full h-full object-cover sm:hidden"
            loading="eager"
        >
    @endif

    {{-- Banner image: desktop --}}
    @if ($desktopSrc)
        <img
            src="{{ $desktopSrc }}"
            alt="{{ $title }}"
            class="absolute inset-0 w-full h-full object-cover hidden sm:block"
            loading="eager"
        >
    @endif

    {{-- Overlay gradient supaya teks tetap kebaca --}}
    <div class="absolute inset-0 bg-gradient-to-t from-forest-dark/70 via-forest-dark/20 to-forest-dark/0"></div>

    {{-- Content --}}
    <div class="relative h-full max-w-7xl mx-auto px-6 lg:px-8 flex flex-col justify-end pb-10 lg:pb-14">
        @if($label)
            <span class="text-xs font-contax font-medium tracking-wide uppercase text-blush">{{ $label }}</span>
        @endif

        <h1 class="mt-3 font-contax text-4xl sm:text-5xl leading-tight max-w-2xl text-ivory">
            {{ $title }}
        </h1>

        @if($subtitle)
            <p class="mt-4 font-contax text-ivory/70 max-w-xl">
                {{ $subtitle }}
            </p>
        @endif

        {{ $slot ?? '' }}
    </div>
</section>