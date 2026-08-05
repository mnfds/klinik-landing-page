<div>
    {{-- HEADER --}}
    <x-page-header
        label="Dokter"
        title="Tim dokter profesional kami"
        subtitle="Kenali dokter yang siap menangani perawatanmu."
        image="{{ asset('images/banner/doctors.png') }}"
    />

    @include('partials.landing.divider')

    {{-- DOCTOR LIST --}}
    <section class="bg-ivory py-16 lg:py-20">
        <div class="max-w-5xl mx-auto px-6 lg:px-8 space-y-8">
            @forelse ($this->doctorsList as $doctor)
                <div wire:key="doctor-{{ $loop->index }}" class="rounded-2xl border border-forest/10 bg-white overflow-hidden lg:flex">

                    {{-- Photo --}}
                    <div class="lg:w-64 shrink-0 aspect-[4/3] lg:aspect-auto bg-gradient-to-br from-blush/50 via-blush/20 to-ivory flex items-center justify-center">
                        <svg viewBox="0 0 24 24" class="w-12 h-12 text-forest/25" fill="none" stroke="currentColor" stroke-width="1">
                            <circle cx="12" cy="8" r="4" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>

                    {{-- Info --}}
                    <div class="p-6 lg:p-8 flex-1">
                        <h3 class="font-display text-xl text-forest-dark">{{ $doctor['name'] }}</h3>
                        <p class="mt-1 text-sm text-gold font-medium">{{ $doctor['specialization'] }}</p>
                        <p class="mt-3 text-sm text-charcoal/60 leading-relaxed">{{ $doctor['bio'] }}</p>

                        {{-- Schedule --}}
                        <div class="mt-5">
                            <p class="text-xs font-medium tracking-wide uppercase text-charcoal/40 mb-3">Jadwal Praktik</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($this->sortedSchedules($doctor['schedules']) as $schedule)
                                    <span class="inline-flex items-center gap-2 rounded-full bg-forest/5 border border-forest/10 px-4 py-2 text-sm text-charcoal/80">
                                        <span class="font-medium text-forest-dark">{{ $this->dayLabel($schedule['day']) }}</span>
                                        <span class="text-charcoal/40">•</span>
                                        <span>{{ $schedule['start_time'] }}–{{ $schedule['end_time'] }}</span>
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        
                        <a href="https://wa.me/6285822810149?text={{ urlencode('Halo, saya ingin booking dengan ' . $doctor['name']) }}"
                            target="_blank"
                            rel="noopener"
                            class="mt-6 inline-flex items-center justify-center gap-2 rounded-full bg-forest px-6 py-2.5 text-sm font-medium text-ivory transition-all duration-300 hover:bg-forest-dark"
                        >
                            Booking dengan Dokter Ini
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-16">
                    <p class="text-charcoal/50">Belum ada data dokter tersedia.</p>
                </div>
            @endforelse
        </div>
    </section>
</div>