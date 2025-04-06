{{-- <x-guest-layout>
    <x-authentication-card class="max-w-md mx-auto mt-12 p-6 bg-white rounded-lg shadow-lg">
        <x-slot name="logo">
            <div class="flex items-center space-x-2">
                <x-authentication-card-logo class="w-12 h-12" />
                <span class="text-4xl font-bold text-gray-800">Scientia</span>
            </div>
            <h2 class="text-center text-2xl font-semibold text-gray-700">¡Bienvenido de nuevo!</h2>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email input -->
            <div class="mt-4">
                <x-label for="email" value="{{ __('Correo electrónico') }}" />
                <x-input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <!-- Password input -->
            <div class="mt-4">
                <div class="flex items-center justify-between">
                    <x-label for="password" value="{{ __('Contraseña') }}" />
                    @if (Route::has('password.request'))
                        <a class="underline text-xs text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a>
                    @endif
                </div>
                <x-input id="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password" required autocomplete="current-password" />
            </div>

            <!-- Remember me checkbox -->
            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Mantener sesión activa') }}</span>
                </label>
            </div>

            <!-- Forgot password and submit button -->
            <div class="flex items-center justify-between mt-4">
                @if (Route::has('register'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('¿Ya tienes cuenta? Registrate') }}
                    </a>
                @endif

                <x-button class="ml-4 bg-indigo-600 hover:bg-indigo-700 text-white">
                    {{ __('Iniciar sesión') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}

<x-guest-layout>
    <x-authentication-card class="max-w-md mx-auto mt-12 p-8 bg-white rounded-lg shadow-lg">
        <x-slot name="logo">
            <div class="flex items-center justify-center space-x-3 mb-6">
                <x-authentication-card-logo class="w-12 h-12" />
                <span class="text-4xl font-extrabold text-gray-800">Scientia</span>
            </div>
            <h2 class="text-center text-2xl font-semibold text-gray-600">¡Bienvenido de nuevo!</h2>
        </x-slot>

        <x-validation-errors class="mb-4 text-sm text-red-600" />

        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email input -->
            <div class="mt-6">
                <x-label for="email" value="{{ __('Correo electrónico') }}" />
                <x-input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <!-- Password input -->
            <div class="mt-6">
                <div class="flex items-center justify-between">
                    <x-label for="password" value="{{ __('Contraseña') }}" />
                    @if (Route::has('password.request'))
                        <a class="underline text-xs text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a>
                    @endif
                </div>
                <x-input id="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password" required autocomplete="current-password" />
            </div>

            <!-- Remember me checkbox -->
            <div class="block mt-6">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Mantener sesión activa') }}</span>
                </label>
            </div>

            <!-- Forgot password and submit button -->
            <div class="flex items-center justify-between mt-6">
                @if (Route::has('register'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" href="{{ route('register') }}">
                        {{ __('¿No tienes cuenta? Regístrate') }}
                    </a>
                @endif

                <x-button class="ml-4 bg-gray-600 hover:bg-gray-700 text-white rounded-full px-6 py-2">
                    {{ __('Iniciar sesión') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
