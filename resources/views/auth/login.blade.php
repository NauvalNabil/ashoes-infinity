<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Demo Accounts Info -->
    <div class="mb-6 p-4 bg-gray-800 border border-pink-400 rounded-lg">
        <h3 class="text-lg font-semibold text-pink-400 mb-3">Demo Accounts</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div class="bg-gray-700 p-3 rounded">
                <h4 class="font-semibold text-pink-300 mb-2">Admin Account</h4>
                <p class="text-gray-300">Email: <span class="text-white">admin@ashoes.com</span></p>
                <p class="text-gray-300">Password: <span class="text-white">admin123</span></p>
            </div>
            <div class="bg-gray-700 p-3 rounded">
                <h4 class="font-semibold text-pink-300 mb-2">User Account</h4>
                <p class="text-gray-300">Email: <span class="text-white">user@ashoes.com</span></p>
                <p class="text-gray-300">Password: <span class="text-white">user123</span></p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email"
                class="block mt-1 w-full bg-gray-800 text-gray-100 border-gray-600 focus:border-pink-400 focus:ring-pink-400 rounded-md shadow-sm"
                type="email"
                name="email"
                :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password"
                class="block mt-1 w-full bg-gray-800 text-gray-100 border-gray-600 focus:border-pink-400 focus:ring-pink-400 rounded-md shadow-sm"
                type="password"
                name="password"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-600 text-pink-600 shadow-sm focus:ring-pink-400 bg-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-400 hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 focus:ring-offset-gray-800"
                   href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
