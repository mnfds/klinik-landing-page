<div>
    {{-- Header --}}
    <div class="mb-7">
        <h1 class="font-fraunces text-2xl text-forest">Dashboard</h1>
        <p class="text-sm text-charcoal/60 mt-0.5">Ringkasan aktivitas klinik hari ini.</p>
    </div>

    {{-- Stat utama --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-8">
        <div class="bg-white rounded-xl border border-blue-300 px-4 py-3.5 shadow-md">
            <div class="flex items-center justify-between">
                <p class="text-xs text-charcoal/50">Layanan</p>
                <i class="fa-solid fa-spa text-forest/30 text-sm"></i>
            </div>
            <p class="text-2xl font-fraunces text-forest mt-1">{{ $stats['services'] }}</p>
            <p class="text-[11px] text-charcoal/40 mt-0.5">{{ $stats['servicesActive'] }} aktif</p>
        </div>

        <div class="bg-white rounded-xl border border-blue-300 px-4 py-3.5 shadow-md">
            <div class="flex items-center justify-between">
                <p class="text-xs text-charcoal/50">Produk</p>
                <i class="fa-solid fa-box text-forest/30 text-sm"></i>
            </div>
            <p class="text-2xl font-fraunces text-forest mt-1">{{ $stats['products'] }}</p>
            <p class="text-[11px] text-charcoal/40 mt-0.5">{{ $stats['productsActive'] }} aktif</p>
        </div>

        <div class="bg-white rounded-xl border border-blue-300 px-4 py-3.5 shadow-md">
            <div class="flex items-center justify-between">
                <p class="text-xs text-charcoal/50">Promo</p>
                <i class="fa-solid fa-tag text-forest/30 text-sm"></i>
            </div>
            <p class="text-2xl font-fraunces text-forest mt-1">{{ $stats['promos'] }}</p>
            <p class="text-[11px] text-charcoal/40 mt-0.5">{{ $stats['promosOngoing'] }} berlangsung</p>
        </div>

        <div class="bg-white rounded-xl border border-blue-300 px-4 py-3.5 shadow-md">
            <div class="flex items-center justify-between">
                <p class="text-xs text-charcoal/50">Dokter</p>
                <i class="fa-solid fa-user-doctor text-forest/30 text-sm"></i>
            </div>
            <p class="text-2xl font-fraunces text-forest mt-1">{{ $stats['doctors'] }}</p>
            <p class="text-[11px] text-charcoal/40 mt-0.5">{{ $stats['doctorsActive'] }} aktif</p>
        </div>
    </div>

    {{-- Stat sekunder: testimoni --}}
    <div class="grid grid-cols-2 gap-3 mb-8">
        <div class="bg-white rounded-xl border border-blue-300 px-4 py-3.5 shadow-md">
            <div class="flex items-center justify-between">
                <p class="text-xs text-charcoal/50">Total Testimoni</p>
                <i class="fa-solid fa-comment-dots text-forest/30 text-sm"></i>
            </div>
            <p class="text-2xl font-fraunces text-forest mt-1">{{ $stats['testimonials'] }}</p>
        </div>

        <div class="bg-white rounded-xl border border-blue-300 px-4 py-3.5 shadow-md">
            <div class="flex items-center justify-between">
                <p class="text-xs text-charcoal/50">Rating Rata-rata</p>
                <i class="fa-solid fa-star text-gold/50 text-sm"></i>
            </div>
            <p class="text-2xl font-fraunces text-forest mt-1 flex items-center gap-1.5">
                {{ number_format($stats['ratingAvg'] ?? 0, 1) }}
                <span class="text-gold text-base">★</span>
            </p>
        </div>
    </div>

    {{-- Quick access --}}
    {{-- <div class="mb-8">
        <h2 class="font-fraunces text-lg text-forest mb-3">Akses Cepat</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
            @foreach ([
                ['route' => 'admin.services.index', 'icon' => 'fa-spa', 'label' => 'Layanan'],
                ['route' => 'admin.products.index', 'icon' => 'fa-box', 'label' => 'Produk'],
                ['route' => 'admin.promos.index', 'icon' => 'fa-tag', 'label' => 'Promo'],
                ['route' => 'admin.doctors.index', 'icon' => 'fa-user-doctor', 'label' => 'Dokter'],
                ['route' => 'admin.testimonials.index', 'icon' => 'fa-comment-dots', 'label' => 'Testimoni'],
                ['route' => 'admin.banner-home.index', 'icon' => 'fa-image', 'label' => 'Banner Home'],
                ['route' => 'admin.banner-page.index', 'icon' => 'fa-images', 'label' => 'Banner Page'],
            ] as $item)
                
                <a href="{{ route($item['route']) }}"
                    wire:navigate
                    class="flex items-center gap-3 bg-white rounded-xl border border-gray-100 px-4 py-3.5 shadow-sm hover:shadow-md hover:border-forest/30 transition-all group"
                >
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-forest/10 to-gold/10 flex items-center justify-center text-forest/60 group-hover:text-forest transition-colors shrink-0">
                        <i class="fa-solid {{ $item['icon'] }} text-sm"></i>
                    </div>
                    <span class="text-sm font-medium text-charcoal">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </div>
    </div> --}}

    {{-- Aktivitas terbaru --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        {{-- Testimoni terbaru --}}
        <div class="bg-white rounded-2xl shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-fraunces text-lg text-forest">Testimoni Terbaru</h2>
                <a href="{{ route('admin.testimonials.index') }}" wire:navigate class="text-xs text-gold hover:underline">
                    Lihat semua
                </a>
            </div>

            <div class="space-y-3">
                @forelse ($recentTestimonials as $testimonial)
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-50 last:border-0 last:pb-0">
                        @if ($testimonial->avatar)
                            <img src="{{ \Storage::url($testimonial->avatar) }}" class="w-9 h-9 object-cover rounded-full shrink-0">
                        @else
                            <div class="w-9 h-9 bg-gradient-to-br from-forest/10 to-gold/10 rounded-full flex items-center justify-center text-forest/40 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2">
                                <p class="text-sm font-medium text-charcoal truncate">{{ $testimonial->name }}</p>
                                <span class="text-gold text-xs shrink-0">{{ str_repeat('★', $testimonial->rating) }}</span>
                            </div>
                            <p class="text-xs text-charcoal/60 truncate mt-0.5">{{ $testimonial->items_testimonials }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-charcoal/40 text-center py-6">Belum ada testimoni.</p>
                @endforelse
            </div>
        </div>

        {{-- Promo akan berakhir --}}
        <div class="bg-white rounded-2xl shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-fraunces text-lg text-forest">Promo Akan Berakhir</h2>
                <a href="{{ route('admin.promos.index') }}" wire:navigate class="text-xs text-gold hover:underline">
                    Lihat semua
                </a>
            </div>

            <div class="space-y-3">
                @forelse ($expiringPromos as $promo)
                    <div class="flex items-center gap-3 pb-3 border-b border-gray-50 last:border-0 last:pb-0">
                        @if ($promo->image)
                            <img src="{{ \Storage::url($promo->image) }}" class="w-11 h-11 object-cover rounded-lg shrink-0">
                        @else
                            <div class="w-11 h-11 bg-gradient-to-br from-forest/10 to-gold/10 rounded-lg flex items-center justify-center text-forest/40 shrink-0">
                                <i class="fa-solid fa-tag text-sm"></i>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-charcoal truncate">{{ $promo->name }}</p>
                            <p class="text-xs text-charcoal/60 mt-0.5">
                                Berakhir {{ $promo->end_date->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-charcoal/40 text-center py-6">Tidak ada promo yang akan berakhir.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>