<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ asset('images/logo-no-text.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/logo-no-text.png') }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fontawesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-indigo-100">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-red-500 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="max-w-screen-xl mx-auto p-4">
                {{ $slot }}
            </main>
        </div>
        <div
            x-data="{
                toasts: [],
                add(type, message) {
                    const id = Date.now() + Math.random();
                    this.toasts.push({ id, type, message, progress: 100 });

                    const duration = 4000;
                    const start = Date.now();
                    const tick = setInterval(() => {
                        const toast = this.toasts.find(t => t.id === id);
                        if (!toast) return clearInterval(tick);

                        const elapsed = Date.now() - start;
                        toast.progress = Math.max(0, 100 - (elapsed / duration) * 100);

                        if (elapsed >= duration) {
                            clearInterval(tick);
                            this.remove(id);
                        }
                    }, 30);
                },
                remove(id) {
                    this.toasts = this.toasts.filter(t => t.id !== id);
                }
            }"
            x-on:toast.window="add($event.detail.type, $event.detail.message)"
            class="fixed top-5 right-5 z-50 flex flex-col gap-3 pointer-events-none"
        >
            <template x-for="toast in toasts" :key="toast.id">
                <div
                    x-show="true"
                    x-transition:enter="transition ease-out duration-400"
                    x-transition:enter-start="opacity-0 translate-x-6 scale-90"
                    x-transition:enter-end="opacity-100 translate-x-0 scale-100"
                    x-transition:leave="transition ease-in duration-250"
                    x-transition:leave-start="opacity-100 translate-x-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-x-6 scale-90"
                    class="max-w-sm w-full overflow-hidden rounded-xl border shadow-lg pointer-events-auto"
                    :class="toast.type === 'success' ? 'bg-green-200 border-green-500' : 'bg-red-200 border-red-500'"
                >
                    <div
                        class="px-4 py-3 flex items-center gap-2.5 text-sm"
                        :class="toast.type === 'success' ? 'text-green-700' : 'text-red-700'"
                    >
                        <span
                            class="flex items-center justify-center w-5 h-5 rounded-full shrink-0 animate-[bounce_0.5s_ease-in-out]"
                            :class="toast.type === 'success' ? 'bg-green-100' : 'bg-red-100'"
                        >
                            <svg x-show="toast.type === 'success'" xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <svg x-show="toast.type === 'error'" xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </span>

                        <span class="flex-1" x-text="toast.message"></span>

                        <button
                            type="button"
                            @click="remove(toast.id)"
                            class="hover:rotate-90 transition-transform duration-200 shrink-0"
                            :class="toast.type === 'success' ? 'text-green-700/50 hover:text-green-700' : 'text-red-700/50 hover:text-red-700'"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="h-1 w-full bg-black/5">
                        <div
                            class="h-full transition-[width] duration-75 ease-linear"
                            :class="toast.type === 'success' ? 'bg-green-500' : 'bg-red-500'"
                            :style="`width: ${toast.progress}%`"
                        ></div>
                    </div>
                </div>
            </template>
        </div>
    </body>
</html>
