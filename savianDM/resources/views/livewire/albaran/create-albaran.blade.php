<div>
    <button wire:click="abrirModalCrear"
        class="inline-flex items-center px-8 py-4 bg-slate-800 hover:bg-black text-white text-xs font-black uppercase tracking-widest rounded-2xl transition-all shadow-lg hover:-translate-y-1">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Nuevo Albarán
    </button>

    <x-dialog-modal wire:model="openCrear" maxWidth="2xl">
        <x-slot name="title">
            @php $formPath = $isEditing ? 'updateForm' : 'createForm'; @endphp
            <div class="flex justify-between items-center w-full">
                <div>
                    <h3 class="text-2xl font-black text-slate-800 tracking-tighter">
                        {{ $isEditing ? 'Editar Albarán #' . $updateForm->albaranModel?->id : 'Configurar Albarán' }}
                    </h3>
                    <p class="text-slate-400 text-xs font-medium italic mt-1">Actualiza la información del stock</p>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-8 py-4">

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                    <!-- Encabezado con línea decorativa -->
                    <div class="flex items-center gap-3 mb-8">
                        <div class="h-8 w-1.5 bg-slate-800 rounded-full"></div>
                        <h3 class="text-lg font-bold text-slate-800 tracking-tight">DATOS GENERALES</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-8 gap-x-6">

                        <!-- Empresa -->
                        <div class="group space-y-2">
                            <label
                                class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 ml-1 group-focus-within:text-slate-800 transition-colors">
                                Empresa
                            </label>
                            <div class="relative">
                                <select wire:model.live="{{ $formPath }}.empresa_id"
                                    class="appearance-none w-full bg-slate-50 border-slate-200 rounded-2xl py-3.5 pl-4 pr-10 text-sm font-semibold text-slate-700 focus:bg-white focus:border-slate-800 focus:ring-4 focus:ring-slate-800/5 transition-all outline-none cursor-pointer">
                                    <option value="">Seleccionar empresa...</option>
                                    @foreach ($empresas as $e)
                                        <option value="{{ $e->id }}">{{ $e->nombre }}</option>
                                    @endforeach
                                </select>
                                <div
                                    class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error for="{{ $formPath }}.empresa_id" class="mt-1 ml-1" />
                        </div>

                        <!-- Centro de Trabajo -->
                        <div class="group space-y-2">
                            <label
                                class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 ml-1 group-focus-within:text-slate-800 transition-colors">
                                Centro de Trabajo
                            </label>
                            <div class="relative">
                                <select wire:model="{{ $formPath }}.centro_trabajo_id"
                                    class="appearance-none w-full bg-slate-50 border-slate-200 rounded-2xl py-3.5 pl-4 pr-10 text-sm font-semibold text-slate-700 focus:bg-white focus:border-slate-800 focus:ring-4 focus:ring-slate-800/5 transition-all outline-none cursor-pointer">
                                    <option value="">Seleccionar centro...</option>
                                    @foreach ($centros as $c)
                                        <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                                    @endforeach
                                </select>
                                <div
                                    class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error for="{{ $formPath }}.centro_trabajo_id" class="mt-1 ml-1" />
                        </div>

                        <!-- Lugar / Referencia -->
                        <div class="group space-y-2">
                            <label
                                class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 ml-1 group-focus-within:text-slate-800 transition-colors">
                                Lugar / Referencia
                            </label>
                            <input type="text" wire:model="{{ $formPath }}.lugar"
                                placeholder="Ej: Oficina central..."
                                class="w-full bg-slate-50 border-slate-200 rounded-2xl py-3.5 px-4 text-sm font-semibold text-slate-700 placeholder:text-slate-400 placeholder:font-normal focus:bg-white focus:border-slate-800 focus:ring-4 focus:ring-slate-800/5 transition-all outline-none" />
                            <x-input-error for="{{ $formPath }}.lugar" class="mt-1 ml-1" />
                        </div>

                        <!-- Fecha -->
                        <div class="group space-y-2">
                            <label
                                class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 ml-1 group-focus-within:text-slate-800 transition-colors">
                                Fecha del documento
                            </label>
                            <input type="date" wire:model="{{ $formPath }}.fecha"
                                class="w-full bg-slate-50 border-slate-200 rounded-2xl py-3.5 px-4 text-sm font-semibold text-slate-700 focus:bg-white focus:border-slate-800 focus:ring-4 focus:ring-slate-800/5 transition-all outline-none cursor-text" />
                            <x-input-error for="{{ $formPath }}.fecha" class="mt-1 ml-1" />
                        </div>

                        <!-- Nombre Firmante -->
                        <div class="group space-y-2 md:col-span-2 lg:col-span-1">
                            <label
                                class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 ml-1 group-focus-within:text-slate-800 transition-colors">
                                Nombre del Firmante
                            </label>
                            <div class="relative">
                                <input type="text" wire:model="{{ $formPath }}.nombre_firmante"
                                    placeholder="Nombre completo..."
                                    class="w-full bg-slate-50 border-slate-200 rounded-2xl py-3.5 pl-11 pr-4 text-sm font-semibold text-slate-700 placeholder:text-slate-400 placeholder:font-normal focus:bg-white focus:border-slate-800 focus:ring-4 focus:ring-slate-800/5 transition-all outline-none" />
                                <div
                                    class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error for="{{ $formPath }}.nombre_firmante" class="mt-1 ml-1" />
                        </div>

                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 mt-6">
                    <!-- Encabezado con línea decorativa (Igual al anterior) -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-1.5 bg-[#07CBBB] rounded-full"></div>
                            <h3 class="text-lg font-bold text-slate-800 tracking-tight uppercase">Trabajadores</h3>
                        </div>
                        <i class="fa-solid fa-chevron-down text-slate-400 text-sm"></i>
                    </div>

                    <!-- Contenedor de Trabajadores -->
                    <div class="space-y-6">
                        @foreach ($isEditing ? $updateForm->trabajadores : $createForm->trabajadores as $index => $trabajador)
                            <div class="p-5 rounded-2xl bg-slate-50/50 border border-slate-100 relative group transition-all hover:bg-white hover:shadow-md"
                                wire:key="trabajador-{{ $index }}">

                                <div class="flex items-center justify-between mb-4">
                                    <span
                                        class="text-[10px] font-black uppercase tracking-widest text-[#07CBBB]">Trabajador
                                        {{ $index + 1 }}</span>

                                    {{-- Botón Eliminar --}}
                                    <button type="button" wire:click="quitarTrabajador({{ $index }})"
                                        class="text-slate-300 hover:text-red-500 transition-colors">
                                        <i class="fa-solid fa-circle-xmark text-lg"></i>
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                                    <!-- Nombre del Técnico -->
                                    <div class="md:col-span-6 space-y-2">
                                        <label
                                            class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 ml-1">Nombre
                                            del técnico</label>
                                        <div class="relative">
                                            <input type="text" placeholder="Escribir nombre..."
                                                wire:model="{{ $formPath }}.trabajadores.{{ $index }}.nombre"
                                                class="w-full bg-white border-slate-200 rounded-2xl py-3.5 px-4 text-sm font-semibold text-slate-700 focus:border-[#07CBBB] focus:ring-4 focus:ring-[#07CBBB]/5 transition-all outline-none" />
                                        </div>
                                        <x-input-error
                                            for="{{ $formPath }}.trabajadores.{{ $index }}.nombre" />
                                    </div>

                                    <!-- Entrada -->
                                    <div class="md:col-span-3 space-y-2">
                                        <label
                                            class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 ml-1">Entrada</label>
                                        <div class="relative">
                                            <input type="time"
                                                wire:model="{{ $formPath }}.trabajadores.{{ $index }}.entrada"
                                                class="w-full bg-white border-slate-200 rounded-2xl py-3.5 px-4 text-sm font-semibold text-slate-700 focus:border-[#07CBBB] focus:ring-4 focus:ring-[#07CBBB]/5 transition-all outline-none" />
                                            <div
                                                class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400">
                                                <i class="fa-regular fa-clock text-xs"></i>
                                            </div>
                                        </div>
                                        <x-input-error
                                            for="{{ $formPath }}.trabajadores.{{ $index }}.entrada" />
                                    </div>

                                    <!-- Salida -->
                                    <div class="md:col-span-3 space-y-2">
                                        <label
                                            class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 ml-1">Salida</label>
                                        <div class="relative">
                                            <input type="time"
                                                wire:model="{{ $formPath }}.trabajadores.{{ $index }}.salida"
                                                class="w-full bg-white border-slate-200 rounded-2xl py-3.5 px-4 text-sm font-semibold text-slate-700 focus:border-[#07CBBB] focus:ring-4 focus:ring-[#07CBBB]/5 transition-all outline-none" />
                                            <div
                                                class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400">
                                                <i class="fa-regular fa-clock text-xs"></i>
                                            </div>
                                        </div>
                                        <x-input-error
                                            for="{{ $formPath }}.trabajadores.{{ $index }}.salida" />
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Botón Añadir Trabajador (Estilo Minimalista) -->
                        <button type="button" wire:click="addTrabajador"
                            class="w-full py-4 border-2 border-dashed border-slate-200 rounded-2xl text-slate-400 font-bold text-sm hover:border-[#07CBBB] hover:text-[#07CBBB] hover:bg-[#07CBBB]/5 transition-all flex items-center justify-center gap-2">
                            <i class="fa-solid fa-plus text-xs"></i>
                            Añadir trabajador
                        </button>
                    </div>





                </div>
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 mt-6">
                    <!-- Encabezado con línea decorativa corporativa -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-1.5 bg-[#07CBBB] rounded-full"></div>
                            <h3 class="text-lg font-bold text-slate-800 tracking-tight uppercase">Tipo de Trabajo</h3>
                        </div>
                        <i class="fa-solid fa-chevron-down text-slate-400 text-sm"></i>
                    </div>

                    <div class="space-y-8">
                        <!-- Grid de Radio Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <!-- Opción: Incidencia -->
                            <label class="relative flex cursor-pointer">
                                <input type="radio" wire:model="{{ $formPath }}.tipo_trabajo"
                                    value="incidencia" class="peer sr-only" name="tipo_trabajo">
                                <div
                                    class="w-full flex items-center justify-center gap-3 p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl transition-all peer-checked:border-[#07CBBB] peer-checked:bg-[#07CBBB]/5 peer-checked:shadow-sm group">
                                    <span class="text-xl group-hover:scale-110 transition-transform">⚠️</span>
                                    <span
                                        class="text-sm font-bold text-slate-600 peer-checked:text-[#07CBBB]">Incidencia</span>

                                    <!-- Check decorativo que aparece al seleccionar -->
                                    <div
                                        class="absolute top-3 right-3 opacity-0 peer-checked:opacity-100 transition-opacity">
                                        <i class="fa-solid fa-circle-check text-[#07CBBB]"></i>
                                    </div>
                                </div>
                            </label>

                            <!-- Opción: Visita -->
                            <label class="relative flex cursor-pointer">
                                <input type="radio" wire:model="{{ $formPath }}.tipo_trabajo" value="visita"
                                    class="peer sr-only" name="tipo_trabajo">
                                <div
                                    class="w-full flex items-center justify-center gap-3 p-4 bg-slate-50 border-2 border-slate-100 rounded-2xl transition-all peer-checked:border-[#07CBBB] peer-checked:bg-[#07CBBB]/5 peer-checked:shadow-sm group">
                                    <span class="text-xl group-hover:scale-110 transition-transform">📋</span>
                                    <span
                                        class="text-sm font-bold text-slate-600 peer-checked:text-[#07CBBB]">Visita</span>

                                    <div
                                        class="absolute top-3 right-3 opacity-0 peer-checked:opacity-100 transition-opacity">
                                        <i class="fa-solid fa-circle-check text-[#07CBBB]"></i>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <x-input-error for="{{ $formPath }}.tipo_trabajo" class="mt-1" />

                        <!-- Área de Texto: Trabajos Realizados -->
                        <div class="group space-y-2">
                            <label
                                class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 ml-1 group-focus-within:text-slate-800 transition-colors">
                                Trabajos Realizados
                            </label>
                            <div class="relative">
                                <textarea wire:model="{{ $formPath }}.descripcion" rows="4"
                                    placeholder="Describe detalladamente los trabajos realizados..."
                                    class="w-full bg-slate-50 border-slate-200 rounded-2xl py-4 px-5 text-sm font-semibold text-slate-700 placeholder:text-slate-400 placeholder:font-normal focus:bg-white focus:border-[#07CBBB] focus:ring-4 focus:ring-[#07CBBB]/5 transition-all outline-none resize-none"></textarea>

                                <!-- Decoración en la esquina inferior para el textarea -->
                                <div class="absolute bottom-3 right-4 pointer-events-none opacity-20">
                                    <i class="fa-solid fa-pen-nib text-xs text-slate-400"></i>
                                </div>
                            </div>
                            <x-input-error for="{{ $formPath }}.descripcion" class="mt-1 ml-1" />
                        </div>
                    </div>
                </div>
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Estado</label>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach (['pendiente', 'entregado', 'retirado'] as $est)
                            <label class="relative cursor-pointer group text-center">
                                <input type="radio" wire:model="{{ $formPath }}.estado"
                                    value="{{ $est }}" class="peer sr-only">
                                <div
                                    class="p-4 rounded-2xl border-2 border-slate-100 bg-slate-50/50 transition-all peer-checked:border-slate-800 peer-checked:bg-slate-800 peer-checked:text-white">
                                    <p class="text-[10px] font-black uppercase tracking-tighter">{{ $est }}
                                    </p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="bg-slate-50/50 rounded-[2rem] p-6 border border-slate-100">
                    <div class="flex justify-between items-center mb-4 px-2">
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Móviles
                            Vinculados</span>
                        <button type="button" wire:click="$toggle('showMovilModal')"
                            class="text-[10px] font-black text-blue-600 uppercase tracking-widest hover:underline">+
                            BUSCAR</button>
                    </div>

                    @if ($showMovilModal)
                        <div class="relative animate-in slide-in-from-top-2">
                            <input type="text" wire:model.live.debounce.300ms="search" placeholder="IMEI..."
                                class="w-full mb-2 p-3 border-2 border-blue-100 rounded-xl text-sm font-bold outline-none focus:border-blue-400">
                            @if (count($search_results) > 0)
                                <div
                                    class="absolute z-50 w-full bg-white border rounded-xl shadow-xl max-h-40 overflow-auto mb-4">
                                    @foreach ($search_results as $res)
                                        <div wire:click="addMovil({{ $res->id }})"
                                            class="p-3 hover:bg-blue-50 cursor-pointer text-xs font-bold border-b">
                                            {{ $res->codigo }}</div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="grid grid-cols-1 gap-2 mt-4">
                        @foreach ($movilesSeleccionados as $m)
                            <div
                                class="flex justify-between items-center bg-white p-4 rounded-2xl border border-slate-100 shadow-sm transition-all hover:shadow-md">
                                <span
                                    class="text-xs font-black italic text-slate-700 italic tracking-tighter">{{ $m->codigo }}</span>
                                <button wire:click="quitarMovil({{ $m->id }})"
                                    class="text-rose-400 hover:text-rose-600 font-bold p-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                        <x-input-error for="{{ $formPath }}.moviles_ids" />
                    </div>
                    <!-- Sección de Firmas -->
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 mt-8"
                        x-data="{
                            showOverlay: false,
                            currentPad: null,
                            signaturePadInstance: null,
                            firmaSavian: '',
                            firmaCliente: '',

                            init() {
                                this.loadFirmas();

                                this.$watch('$wire.openCrear', (value) => {
                                    if (value) {
                                        setTimeout(() => this.loadFirmas(), 300);
                                    } else {
                                        this.firmaSavian = '';
                                        this.firmaCliente = '';
                                    }
                                });
                            },

                            loadFirmas() {
                                const isEditing = $wire.get('isEditing');
                                const form = isEditing ? 'updateForm' : 'createForm';
                                this.firmaSavian = $wire.get(form + '.firma_trabajador') || '';
                                this.firmaCliente = $wire.get(form + '.firma_cliente') || '';
                            },

                            openPad(type) {
                                this.currentPad = type;
                                this.showOverlay = true;
                                document.body.style.overflow = 'hidden';

                                this.$nextTick(() => {
                                    setTimeout(() => {
                                        const canvas = document.getElementById('sig-canvas');
                                        if (!canvas) return;

                                        const ratio = Math.max(window.devicePixelRatio || 1, 1);
                                        canvas.width = canvas.offsetWidth * ratio;
                                        canvas.height = canvas.offsetHeight * ratio;
                                        canvas.getContext('2d').scale(ratio, ratio);

                                        this.signaturePadInstance = new SignaturePad(canvas, {
                                            backgroundColor: 'rgb(255, 255, 255)',
                                            penColor: 'rgb(0, 0, 0)',
                                            minWidth: 1,
                                            maxWidth: 3
                                        });
                                    }, 150);
                                });
                            },

                            closePad() {
                                this.showOverlay = false;
                                document.body.style.overflow = '';
                                this.signaturePadInstance = null;
                            },

                            clearCanvas() {
                                if (this.signaturePadInstance) this.signaturePadInstance.clear();
                            },

                            savePad() {
                                if (!this.signaturePadInstance || this.signaturePadInstance.isEmpty()) {
                                    alert('Por favor, realiza la firma antes de guardar.');
                                    return;
                                }
                                const dataUrl = this.getTrimmedDataUrl();
                                const form = $wire.get('isEditing') ? 'updateForm' : 'createForm';
                                if (this.currentPad === 'savian') {
                                    this.firmaSavian = dataUrl;
                                    $wire.set(form + '.firma_trabajador', dataUrl);
                                } else {
                                    this.firmaCliente = dataUrl;
                                    $wire.set(form + '.firma_cliente', dataUrl);
                                }
                                this.closePad();
                            },

                            getTrimmedDataUrl() {
                                const canvas = document.getElementById('sig-canvas');
                                const ctx = canvas.getContext('2d');
                                const w = canvas.width;
                                const h = canvas.height;
                                const imgData = ctx.getImageData(0, 0, w, h);
                                const data = imgData.data;

                                let top = h, bottom = 0, left = w, right = 0;

                                for (let y = 0; y < h; y++) {
                                    for (let x = 0; x < w; x++) {
                                        const i = (y * w + x) * 4;
                                        const r = data[i], g = data[i+1], b = data[i+2];
                                        if (r < 250 || g < 250 || b < 250) {
                                            if (y < top) top = y;
                                            if (y > bottom) bottom = y;
                                            if (x < left) left = x;
                                            if (x > right) right = x;
                                        }
                                    }
                                }

                                if (top >= bottom) return this.signaturePadInstance.toDataURL('image/png');

                                const pad = 40;
                                top = Math.max(0, top - pad);
                                bottom = Math.min(h - 1, bottom + pad);
                                left = Math.max(0, left - pad);
                                right = Math.min(w - 1, right + pad);

                                const trimW = right - left + 1;
                                const trimH = bottom - top + 1;
                                const trimmed = ctx.getImageData(left, top, trimW, trimH);

                                const tmpCanvas = document.createElement('canvas');
                                tmpCanvas.width = trimW;
                                tmpCanvas.height = trimH;
                                const tmpCtx = tmpCanvas.getContext('2d');
                                tmpCtx.fillStyle = '#ffffff';
                                tmpCtx.fillRect(0, 0, trimW, trimH);
                                tmpCtx.putImageData(trimmed, 0, 0);

                                return tmpCanvas.toDataURL('image/png');
                            },

                            borrarFirma(type) {
                                const form = $wire.get('isEditing') ? 'updateForm' : 'createForm';
                                if (type === 'savian') {
                                    this.firmaSavian = '';
                                    $wire.set(form + '.firma_trabajador', '');
                                } else {
                                    this.firmaCliente = '';
                                    $wire.set(form + '.firma_cliente', '');
                                }
                            }
                        }">
                        
                        <!-- Título -->
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-1.5 bg-[#07CBBB] rounded-full"></div>
                                <h3 class="text-lg font-black text-[#07CBBB] tracking-tight uppercase">Firmas</h3>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Botón Firma Representante -->
                            <div class="flex flex-col items-center">
                                <button type="button" @click="openPad('savian')"
                                    class="relative w-full h-44 bg-white border-2 border-dashed border-slate-200 rounded-3xl overflow-hidden group hover:border-[#07CBBB]/40 transition-all shadow-inner flex flex-col items-center justify-center cursor-pointer">
                                    <template x-if="firmaSavian">
                                        <img :src="firmaSavian" class="max-h-full max-w-full p-4 object-contain">
                                    </template>
                                    <template x-if="!firmaSavian">
                                        <div class="flex flex-col items-center">
                                            <span class="text-slate-500 font-black text-[11px] uppercase tracking-[0.2em]">Representante Savian</span>
                                            <span class="text-slate-400 text-[9px] font-bold mt-2 opacity-60">Toca para firmar</span>
                                        </div>
                                    </template>
                                </button>
                                <button x-show="firmaSavian" x-cloak type="button" @click="borrarFirma('savian')"
                                    class="mt-4 text-red-500 text-[10px] font-black uppercase tracking-widest hover:underline">
                                    Borrar firma
                                </button>
                            </div>

                            <!-- Botón Firma Cliente -->
                            <div class="flex flex-col items-center">
                                <button type="button" @click="openPad('cliente')"
                                    class="relative w-full h-44 bg-white border-2 border-dashed border-slate-200 rounded-3xl overflow-hidden group hover:border-[#07CBBB]/40 transition-all shadow-inner flex flex-col items-center justify-center cursor-pointer">
                                    <template x-if="firmaCliente">
                                        <img :src="firmaCliente" class="max-h-full max-w-full p-4 object-contain">
                                    </template>
                                    <template x-if="!firmaCliente">
                                        <div class="flex flex-col items-center">
                                            <span class="text-slate-500 font-black text-[11px] uppercase tracking-[0.2em]">Cliente</span>
                                            <span class="text-slate-400 text-[9px] font-bold mt-2 opacity-60">Toca para firmar</span>
                                        </div>
                                    </template>
                                </button>
                                <button x-show="firmaCliente" x-cloak type="button" @click="borrarFirma('cliente')"
                                    class="mt-4 text-red-500 text-[10px] font-black uppercase tracking-widest hover:underline">
                                    Borrar firma
                                </button>
                            </div>
                        </div>

                        <!-- PANTALLA COMPLETA DE FIRMA -->
                        <div x-show="showOverlay"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="fixed inset-0 z-[9999] bg-white flex flex-col"
                            style="display: none;">

                            <!-- Header -->
                            <div class="bg-[#2A8E7E] px-4 py-3 sm:px-6 sm:py-4 flex items-center justify-between text-white shadow-md flex-shrink-0">
                                <div class="flex items-center gap-2 sm:gap-3 font-black uppercase tracking-[0.1em] text-[10px] sm:text-xs">
                                    <span class="text-base sm:text-lg">✍️</span>
                                    <span x-text="currentPad === 'savian' ? 'Firma del representante' : 'Firma del cliente'"></span>
                                </div>
                                <button type="button" @click="clearCanvas()"
                                    class="flex items-center gap-2 bg-[#23786A] px-3 py-2 sm:px-5 sm:py-2.5 rounded-xl text-[9px] sm:text-[10px] font-black uppercase tracking-widest hover:bg-[#1b5d52] transition-all">
                                    <i class="fa-solid fa-trash-can"></i> Borrar
                                </button>
                            </div>

                            <!-- Canvas -->
                            <div class="flex-1 relative bg-white">
                                <canvas id="sig-canvas" class="absolute inset-0 w-full h-full touch-none cursor-crosshair"></canvas>
                            </div>

                            <!-- Footer -->
                            <div class="px-4 py-4 sm:px-6 sm:py-6 grid grid-cols-2 gap-3 sm:gap-4 border-t border-slate-100 bg-slate-50 flex-shrink-0">
                                <button type="button" @click="closePad()"
                                    class="py-4 sm:py-5 bg-white border-2 border-slate-200 rounded-2xl text-slate-600 font-black uppercase text-[10px] tracking-widest hover:bg-slate-100 transition-all">
                                    Cancelar
                                </button>
                                <button type="button" @click="savePad()"
                                    class="py-4 sm:py-5 bg-[#2A8E7E] text-white rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-xl shadow-[#2A8E7E]/20 hover:bg-[#1b5d52] transition-all flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-check text-xs"></i> Hecho
                                </button>
                            </div>
                        </div>

                        <!-- Texto Legal -->
                        <div class="pt-8 border-t border-slate-100 mt-10">
                            <p class="text-[10px] text-slate-400 leading-relaxed text-justify font-medium italic opacity-80">
                                Con la firma de este documento, el cliente reconoce haber sido informado de los trabajos realizados y/o de la entrega o retirada de los dispositivos mencionados en las condiciones especificadas anteriormente. *En caso de entrega, el cliente reconoce haber recibido los dispositivos mencionados, asumiendo la responsabilidad de su uso, conservación y devolución en las condiciones establecidas por Savian.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex gap-3">
                <button wire:click="cerrarModal"
                    class="px-6 py-3 text-[10px] font-black uppercase text-slate-400 hover:text-slate-600 transition-colors">
                    Cancelar
                </button>
                <button wire:click="save" wire:loading.attr="disabled"
                    class="px-10 py-4 bg-slate-800 hover:bg-black text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-slate-200 transition-all hover:-translate-y-1">
                    <span wire:loading.remove>{{ $isEditing ? 'Guardar Cambios' : 'Generar Albarán' }}</span>
                    <span wire:loading>Procesando...</span>
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
