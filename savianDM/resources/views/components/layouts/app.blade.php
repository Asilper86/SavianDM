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
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900" x-data>
        <!-- Sidebar Navigation -->
        @livewire('navigation-menu')

        <!-- Mobile/Tablet Header -->
        <div class="lg:hidden bg-[#07CBBB] dark:bg-gray-900 flex items-center justify-between p-4 z-40 sticky top-0 border-b border-white/10">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('assets/img/logo_savian_blanco_v2.fw.png') }}" class="h-8 w-auto" />
                </a>
            </div>
            <button @click="$store.sidebar.open = !$store.sidebar.open" class="text-white hover:text-white/80 focus:outline-none transition-colors">
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
        <div x-show="$store.sidebar.open" style="display: none;" x-transition.opacity @click="$store.sidebar.open = false" class="fixed inset-0 bg-black/50 z-40 lg:hidden"></div>
    </div>

    @stack('modals')

    @livewireScripts
    <x-mios.mensajeerror/>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('sidebar', {
                open: false
            });
        });

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



        Livewire.on('mensajeerror', txt => {
            Swal.fire({
                icon: "error",
                title: txt,
                showConfirmButton: false,
                timer: 1500
            });
        })
    </script>

    {{-- ═══════════════════════════════════════════════════════ --}}
    {{-- OVERLAY GLOBAL PARA FIRMA DIGITAL (Albaranes)          --}}
    {{-- ═══════════════════════════════════════════════════════ --}}
    <div id="firma-overlay"
        style="display:none; position:fixed; top:0; left:0; width:100vw; z-index:999999; background:#fff; flex-direction:column; overflow:hidden;">
        <div style="flex-shrink:0; background:#2A8E7E; padding:10px 16px; display:flex; align-items:center; justify-content:space-between; color:#fff;">
            <div style="display:flex; align-items:center; gap:8px;">
                <span style="font-size:14px;">✍️</span>
                <span id="firma-overlay-titulo" style="font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.1em;">Firma</span>
            </div>
            <button type="button" onclick="window._firmaOverlay.limpiar()"
                style="background:#23786A; border:none; color:#fff; padding:6px 12px; border-radius:8px; font-size:9px; font-weight:900; text-transform:uppercase; letter-spacing:0.1em; cursor:pointer;">
                🗑 Borrar
            </button>
        </div>
        <div style="flex:1; min-height:0; position:relative; overflow:hidden; background:#fff;">
            <canvas id="sig-canvas" style="position:absolute; top:0; left:0; width:100%; height:100%; touch-action:none; cursor:crosshair;"></canvas>
        </div>
        <div style="flex-shrink:0; display:grid; grid-template-columns:1fr 1fr; gap:10px; padding:10px 12px; border-top:1px solid #f1f5f9; background:#f8fafc;">
            <button type="button" onclick="window._firmaOverlay.cancelar()"
                style="padding:14px 0; background:#fff; border:2px solid #e2e8f0; border-radius:12px; color:#475569; font-weight:900; font-size:10px; text-transform:uppercase; letter-spacing:0.1em; cursor:pointer;">
                Cancelar
            </button>
            <button type="button" onclick="window._firmaOverlay.guardar()"
                style="padding:14px 0; background:#2A8E7E; border:none; border-radius:12px; color:#fff; font-weight:900; font-size:10px; text-transform:uppercase; letter-spacing:0.1em; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:6px;">
                ✓ Hecho
            </button>
        </div>
    </div>
    <script>
    window._firmaOverlay = {
        pad: null, tipo: null,
        abrir(tipo) {
            this.tipo = tipo;
            const el = document.getElementById('firma-overlay');
            document.getElementById('firma-overlay-titulo').textContent =
                tipo === 'savian' ? 'Firma representante' : 'Firma cliente';
            el.style.height = window.innerHeight + 'px';
            el.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                const c = document.getElementById('sig-canvas');
                if (!c) return;
                c.width = c.offsetWidth;
                c.height = c.offsetHeight;
                this.pad = new SignaturePad(c, {
                    backgroundColor: 'rgb(255,255,255)',
                    penColor: 'rgb(0,0,0)', minWidth: 1.5, maxWidth: 3
                });
            }, 100);
        },
        limpiar() { if (this.pad) this.pad.clear(); },
        cancelar() {
            document.getElementById('firma-overlay').style.display = 'none';
            document.body.style.overflow = '';
            this.pad = null;
        },
        guardar() {
            if (!this.pad || this.pad.isEmpty()) { alert('Por favor, realiza la firma antes de guardar.'); return; }
            const dataUrl = this.recortar();
            window.dispatchEvent(new CustomEvent('firma-guardada', { detail: { tipo: this.tipo, dataUrl } }));
            this.cancelar();
        },
        recortar() {
            const canvas = document.getElementById('sig-canvas');
            const ctx = canvas.getContext('2d');
            const w = canvas.width, h = canvas.height;
            const px = ctx.getImageData(0, 0, w, h).data;
            let t = h, b = 0, l = w, r = 0;
            for (let y = 0; y < h; y++) {
                for (let x = 0; x < w; x++) {
                    const i = (y * w + x) * 4;
                    if (px[i] < 250 || px[i+1] < 250 || px[i+2] < 250) {
                        if (y < t) t = y; if (y > b) b = y;
                        if (x < l) l = x; if (x > r) r = x;
                    }
                }
            }
            if (t >= b) return this.pad.toDataURL('image/jpeg', 0.5);
            const p = 20;
            t = Math.max(0, t - p); b = Math.min(h - 1, b + p);
            l = Math.max(0, l - p); r = Math.min(w - 1, r + p);
            const tw = r - l + 1, th = b - t + 1;
            const crop = ctx.getImageData(l, t, tw, th);
            const maxW = 600, sc = tw > maxW ? maxW / tw : 1;
            const ow = Math.round(tw * sc), oh = Math.round(th * sc);
            const c1 = document.createElement('canvas');
            c1.width = tw; c1.height = th;
            const x1 = c1.getContext('2d');
            x1.fillStyle = '#fff'; x1.fillRect(0, 0, tw, th);
            x1.putImageData(crop, 0, 0);
            const c2 = document.createElement('canvas');
            c2.width = ow; c2.height = oh;
            const x2 = c2.getContext('2d');
            x2.fillStyle = '#fff'; x2.fillRect(0, 0, ow, oh);
            x2.drawImage(c1, 0, 0, ow, oh);
            return c2.toDataURL('image/jpeg', 0.6);
        }
    };
    window.addEventListener('resize', () => {
        const el = document.getElementById('firma-overlay');
        if (el && el.style.display === 'flex') el.style.height = window.innerHeight + 'px';
    });
    </script>
</body>

</html>
