<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('admin.dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 text-sm font-medium text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <div class="w-full p-8">

        <h2 class="text-2xl font-bold text-gray-800 mb-1">Login</h2>
        <p class="text-sm text-gray-500 mb-6">Masuk ke akun Anda untuk melanjutkan</p>

        <form wire:submit="login" class="space-y-5">
            <!-- Name (Username) -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">
                    {{ __('Username') }}
                </label>
                <input
                    wire:model="form.name"
                    id="name"
                    type="text"
                    name="name"
                    required
                    autofocus
                    autocomplete="username"
                    class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm
                        focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                />
                @error('form.name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    {{ __('Password') }}
                </label>
                <input
                    wire:model="form.password"
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm
                        focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500"
                />
                @error('form.password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <label for="remember" class="inline-flex items-center">
                    <input
                        wire:model="form.remember"
                        id="remember"
                        type="checkbox"
                        name="remember"
                        class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500"
                    >
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-2">
                @if (Route::has('password.request'))
                    
                    <a href="{{ route('password.request') }}"
                        wire:navigate
                        class="text-sm text-gray-600 hover:text-gray-900 underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500"
                    >
                        {{ __('Forgot your password?') }}
                    </a>
                @else
                    <span></span>
                @endif

                <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 active:bg-emerald-800 transition"
                >
                    {{ __('Log in') }}
                </button>
            </div>
        </form>

    </div>
</div>
