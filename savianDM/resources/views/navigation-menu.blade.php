<nav x-data="{ open: false }"
    class="fixed inset-y-0 left-0 w-64 bg-[#07CBBB] dark:bg-gray-900 border-r border-white/10 z-50 flex flex-col transition-all duration-300">

    <div class="flex items-center justify-center h-20 shrink-0 border-b border-white/10">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/img/logo_savian_blanco_v2.fw.png') }}" class="block h-10 w-auto"/>
        </a>
    </div>

    <div class="flex-grow overflow-y-auto py-6 px-4 space-y-2">
        <p class="text-[10px] uppercase tracking-widest text-white/50 font-bold px-4 mb-2">Menú Principal</p>

        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
            class="flex items-center w-full px-4 py-3 text-white hover:bg-white/10 rounded-xl transition-all border-none">
            <svg class="w-5 h-5 me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>
            {{ __('Dashboard') }}
        </x-nav-link>
        <x-nav-link href="{{ route('moviles') }}" :active="request()->routeIs('moviles')"
            class="flex items-center w-full px-4 py-3 text-white hover:bg-white/10 rounded-xl transition-all border-none">
            <svg class="w-5 h-5 me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>
            Moviles
        </x-nav-link>

    </div>

    <div class="p-4 border-t border-white/10 bg-black/10">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="flex items-center w-full text-sm font-medium text-white hover:bg-white/5 p-2 rounded-lg transition">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="size-8 rounded-full object-cover me-3 border border-white/20"
                            src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    @endif
                    <div class="text-left overflow-hidden">
                        <p class="truncate w-32">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-white/60 truncate italic">Administrador</p>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <div class="block px-4 py-2 text-xs text-gray-400">{{ __('Administrar Cuenta') }}</div>
                <x-dropdown-link href="{{ route('profile.show') }}">{{ __('Perfil') }}</x-dropdown-link>
                <div class="border-t border-gray-200 dark:border-gray-600"></div>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-dropdown-link href="{{ route('logout') }}"
                        @click.prevent="$root.submit();">{{ __('Cerrar Sesión') }}</x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</nav>
