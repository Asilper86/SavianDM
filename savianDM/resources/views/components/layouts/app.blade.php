<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900" x-data="{ sidebarOpen: false }">
        <!-- Sidebar Navigation -->
        @livewire('navigation-menu')

        <!-- Mobile/Tablet Header -->
        <div class="lg:hidden bg-[#07CBBB] dark:bg-gray-900 flex items-center justify-between p-4 z-40 sticky top-0 border-b border-white/10">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('assets/img/logo_savian_blanco_v2.fw.png') }}" class="h-8 w-auto" />
                </a>
            </div>
            <button @click="sidebarOpen = !sidebarOpen" class="text-white hover:text-white/80 focus:outline-none transition-colors">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow lg:ml-64 transition-all duration-300">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="lg:ml-64 transition-all duration-300">
            {{ $slot }}
        </main>

        <!-- Overlay -->
        <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-40 lg:hidden"></div>
    </div>

    @stack('modals')

    @livewireScripts
    <script>
        Livewire.on('mensaje', txt => {
            Swal.fire({
                icon: "success",
                title: txt,
                showConfirmButton: false,
                timer: 1500
            });
        })

        function mostrarDialogoBorrado(vistaDestino) {
            console.log(vistaDestino);
            Swal.fire({
                title: "¿Estas seguro?",
                text: "!Esta acción no se puede desacer!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, borrar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatchTo(vistaDestino, 'evtBorrarOk')
                }
            });
        }

        Livewire.on('evtBorrarMovil', ({destino})=>mostrarDialogoBorrado(destino));
        Livewire.on('evtModeloBorrado', ({destino})=>mostrarDialogoBorrado(destino));
        Livewire.on('evtProveedorBorrado', ({destino})=>mostrarDialogoBorrado(destino));
        Livewire.on('evtEmpresaBorrado', ({destino})=>mostrarDialogoBorrado(destino));
    </script>
</body>

</html>
