<div>
    {{-- HEADER --}}
    <x-page-header
        label="Produk Kami"
        title="Rangkaian skincare pilihan untuk perawatan di rumah"
        subtitle="Konsultasikan dulu dengan tim kami via WhatsApp untuk reomdasi yang sesuai jenis kulitmu"
        image="{{ asset('images/banner/products.png') }}"
    />

    @include('partials.landing.divider')

    {{-- GRID --}}
    <section class="bg-ivory py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($this->productsList as $product)
                    <div wire:key="product-{{ $loop->index }}" class="group rounded-2xl border border-forest/10 overflow-hidden bg-white transition-all duration-300 hover:border-forest/30 hover:shadow-md">
                        {{-- Image placeholder --}}
                        <div class="aspect-square bg-gradient-to-br from-blush/50 via-blush/20 to-ivory flex items-center justify-center">
                            <svg viewBox="0 0 24 24" class="w-10 h-10 text-forest/25" fill="none" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 3h6l1 3h3a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V7a1 1 0 011-1h3l1-3z" />
                            </svg>
                        </div>

                        <div class="p-6">
                            <h3 class="font-display text-lg text-forest-dark">
                                {{ $product['name'] }}
                            </h3>

                            <p class="mt-2 text-sm text-charcoal/60 leading-relaxed line-clamp-2">
                                {{ $product['description'] }}
                            </p>

                            <p class="mt-4 font-display text-lg text-forest">
                                Rp {{ number_format($product['price'], 0, ',', '.') }}
                            </p>

                            <div class="mt-5 flex flex-col gap-2">
                                
                                <a href="{{ route('products.detail', $product['slug']) }}"
                                    wire:navigate
                                    class="block text-center rounded-full bg-forest py-2.5 text-sm font-medium text-ivory transition-all duration-300 hover:bg-forest-dark"
                                >
                                    Lihat Detail
                                </a>
                                
                                <a href="https://wa.me/6285822810149?text={{ urlencode('Halo, saya ingin tanya tentang produk ' . $product['name']) }}"
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
                        <p class="text-charcoal/50">Belum ada produk tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>