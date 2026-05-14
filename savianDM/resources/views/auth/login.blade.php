<x-layouts.guest>
    <x-authentication-card>
        <x-slot name="logo">
            
        </x-slot>

        <div class="mb-8 text-center">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">¡Bienvenido de nuevo!</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Ingresa tus credenciales para acceder</p>
        </div>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/30 p-3 rounded-lg border border-green-200 dark:border-green-800">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" class="text-xs uppercase tracking-widest font-semibold" />
                <x-input id="email" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm" 
                         type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                         placeholder="correo@ejemplo.com" />
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <x-label for="password" value="{{ __('Contraseña') }}" class="text-xs uppercase tracking-widest font-semibold" />
                </div>
                <x-input id="password" class="block mt-1 w-full bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm" 
                         type="password" name="password" required autocomplete="current-password" 
                         placeholder="••••••••" />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center cursor-pointer group">
                    <x-checkbox id="remember_me" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-gray-200 transition-colors">{{ __('Recordarme') }}</span>
                </label>
            </div>

            

            <div class="pt-2">
                <x-button class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-900 focus:ring-indigo-500 shadow-lg shadow-indigo-500/30 transition-all duration-200 text-sm font-bold uppercase tracking-widest">
                    {{ __('Iniciar Sesión') }}
                </x-button>
            </div>


            
        </form>
    </x-authentication-card>
</x-layouts.guest>