<a href="https://wa.me/6285822810149?text={{ urlencode('Halo, saya ingin bertanya tentang layanan klinik.') }}"
    target="_blank"
    rel="noopener"
    aria-label="Chat via WhatsApp"
    x-data="{ show: false }"
    x-init="setTimeout(() => show = true, 600)"
    x-show="show"
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 translate-y-4 scale-90"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    class="group fixed bottom-6 right-6 z-40 flex items-center gap-3"
>
    {{-- Tooltip label, muncul saat hover di desktop --}}
    <span class="hidden sm:block bg-forest-dark text-ivory text-sm font-medium px-4 py-2 rounded-full shadow-md opacity-0 translate-x-2 pointer-events-none transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0">
        Chat dengan kami
    </span>

    {{-- Tombol bulat --}}
    <span class="relative flex items-center justify-center w-12 h-12 rounded-tl-[15px] rounded-ee-[15px] bg-[#25D366] text-ivory shadow-lg transition-transform duration-300 group-hover:scale-105 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gold">
        {{-- Ping animation, subtle --}}
        <span class="absolute inset-0 rounded-tl-[15px] rounded-ee-[15px] bg-[#25D366] animate-ping opacity-20"></span>

        <svg viewBox="0 0 24 24" class="relative w-7 h-7" fill="currentColor">
            <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2 22l5.29-1.39c1.44.79 3.06 1.2 4.71 1.2h.01c5.46 0 9.91-4.45 9.91-9.91C21.92 6.45 17.5 2 12.04 2zm5.8 14.02c-.24.68-1.4 1.3-1.93 1.38-.5.08-1.13.11-1.82-.11-.42-.13-.96-.31-1.65-.6-2.9-1.25-4.79-4.17-4.94-4.36-.14-.19-1.18-1.57-1.18-3 0-1.42.75-2.12 1.02-2.41.26-.28.58-.35.77-.35s.39 0 .56.01c.18.01.42-.07.65.5.24.58.82 2 .89 2.15.07.15.12.32.02.51-.09.19-.14.31-.28.48-.14.16-.29.36-.42.48-.14.13-.28.28-.12.55.16.28.72 1.19 1.54 1.93 1.06.95 1.95 1.24 2.23 1.38.28.13.44.11.6-.07.16-.18.7-.81.88-1.09.19-.28.37-.23.62-.14.26.1 1.63.77 1.91.91.28.14.47.21.54.33.07.12.07.68-.17 1.36z"/>
        </svg>
    </span>
</a>