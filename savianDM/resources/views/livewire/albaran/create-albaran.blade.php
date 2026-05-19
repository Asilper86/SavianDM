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
                    <h3 class="text-2xl font-black text-slate-800 dark:text-white tracking-tighter transition-colors">
                        {{ $isEditing ? 'Editar Albarán #' . $updateForm->albaranModel?->id : 'Configurar Albarán' }}
                    </h3>
                    <p class="text-slate-400 dark:text-gray-400 text-xs font-medium italic mt-1 transition-colors">Actualiza la información del stock</p>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-8 py-4 pb-4">

                <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-gray-700 transition-colors">
                    <!-- Encabezado con línea decorativa -->
                    <div class="flex items-center gap-3 mb-8">
                        <div class="h-8 w-1.5 bg-slate-800 dark:bg-slate-100 rounded-full transition-colors"></div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white tracking-tight transition-colors">DATOS GENERALES</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-8 gap-x-6">

                        <!-- Empresa -->
                        <div class="group space-y-2">
                            <label
                                class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-gray-300 ml-1 group-focus-within:text-slate-800 dark:group-focus-within:text-white transition-colors">
                                Empresa
                            </label>
                            <div class="relative">
                                <select wire:model.live="{{ $formPath }}.empresa_id"
                                    class="appearance-none w-full bg-slate-50 dark:bg-gray-800 border-slate-200 dark:border-gray-600 rounded-2xl py-3.5 pl-4 pr-10 text-sm font-semibold text-slate-700 dark:text-slate-200 focus:bg-white dark:focus:bg-slate-900 focus:border-slate-800 dark:focus:border-slate-500 focus:ring-4 focus:ring-slate-800/5 transition-all outline-none cursor-pointer">
                                    <option value="">Seleccionar empresa...</option>
                                    @foreach ($empresas as $e)
                                        <option value="{{ $e->id }}">{{ $e->nombre }}</option>
                                    @endforeach
                                </select>
                                <div
                                    class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400 dark:text-gray-400">
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
                                class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-gray-300 ml-1 group-focus-within:text-slate-800 dark:group-focus-within:text-white transition-colors">
                                Centro de Trabajo
                            </label>
                            <div class="relative">
                                <select wire:model="{{ $formPath }}.centro_trabajo_id"
                                    class="appearance-none w-full bg-slate-50 dark:bg-gray-800 border-slate-200 dark:border-gray-600 rounded-2xl py-3.5 pl-4 pr-10 text-sm font-semibold text-slate-700 dark:text-slate-200 focus:bg-white dark:focus:bg-slate-900 focus:border-slate-800 dark:focus:border-slate-500 focus:ring-4 focus:ring-slate-800/5 transition-all outline-none cursor-pointer">
                                    <option value="">Seleccionar centro...</option>
                                    @foreach ($centros as $c)
                                        <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                                    @endforeach
                                </select>
                                <div
                                    class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400 dark:text-gray-400">
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
                                class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-gray-300 ml-1 group-focus-within:text-slate-800 dark:group-focus-within:text-white transition-colors">
                                Lugar / Referencia
                            </label>
                            <input type="text" wire:model="{{ $formPath }}.lugar"
                                placeholder="Ej: Oficina central..."
                                class="w-full bg-slate-50 dark:bg-gray-800 border-slate-200 dark:border-gray-600 rounded-2xl py-3.5 px-4 text-sm font-semibold text-slate-700 dark:text-slate-200 placeholder:text-slate-400 dark:placeholder:text-slate-500 placeholder:font-normal focus:bg-white dark:focus:bg-slate-900 focus:border-slate-800 dark:focus:border-slate-500 focus:ring-4 focus:ring-slate-800/5 transition-all outline-none" />
                            <x-input-error for="{{ $formPath }}.lugar" class="mt-1 ml-1" />
                        </div>

                        <!-- Fecha -->
                        <div class="group space-y-2">
                            <label
                                class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-gray-300 ml-1 group-focus-within:text-slate-800 dark:group-focus-within:text-white transition-colors">
                                Fecha del documento
                            </label>
                            <input type="date" wire:model="{{ $formPath }}.fecha"
                                class="w-full bg-slate-50 dark:bg-gray-800 border-slate-200 dark:border-gray-600 rounded-2xl py-3.5 px-4 text-sm font-semibold text-slate-700 dark:text-slate-200 focus:bg-white dark:focus:bg-slate-900 focus:border-slate-800 dark:focus:border-slate-500 focus:ring-4 focus:ring-slate-800/5 transition-all outline-none cursor-text [color-scheme:light] dark:[color-scheme:dark]" />
                            <x-input-error for="{{ $formPath }}.fecha" class="mt-1 ml-1" />
                        </div>

                        <!-- Nombre Firmante -->
                        <div class="group space-y-2 md:col-span-2 lg:col-span-1">
                            <label
                                class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-gray-300 ml-1 group-focus-within:text-slate-800 dark:group-focus-within:text-white transition-colors">
                                Nombre del Firmante
                            </label>
                            <div class="relative">
                                <input type="text" wire:model="{{ $formPath }}.nombre_firmante"
                                    placeholder="Nombre completo..."
                                    class="w-full bg-slate-50 dark:bg-gray-800 border-slate-200 dark:border-gray-600 rounded-2xl py-3.5 pl-11 pr-4 text-sm font-semibold text-slate-700 dark:text-slate-200 placeholder:text-slate-400 dark:placeholder:text-slate-500 placeholder:font-normal focus:bg-white dark:focus:bg-slate-900 focus:border-slate-800 dark:focus:border-slate-500 focus:ring-4 focus:ring-slate-800/5 transition-all outline-none" />
                                <div
                                    class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-slate-400 dark:text-gray-400">
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

                <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-gray-700 mt-6 transition-colors">
                    <!-- Encabezado con línea decorativa (Igual al anterior) -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-1.5 bg-[#07CBBB] rounded-full"></div>
                            <h3 class="text-lg font-bold text-slate-800 dark:text-white tracking-tight uppercase transition-colors">Trabajadores</h3>
                        </div>
                        <i class="fa-solid fa-chevron-down text-slate-400 dark:text-gray-400 text-sm"></i>
                    </div>

                    <!-- Contenedor de Trabajadores -->
                    <div class="space-y-6">
                        @foreach ($isEditing ? $updateForm->trabajadores : $createForm->trabajadores as $index => $trabajador)
                            <div class="p-5 rounded-2xl bg-slate-50/50 dark:bg-gray-800/50 border border-slate-100 dark:border-gray-600/50 relative group transition-all hover:bg-white dark:hover:bg-slate-800 hover:shadow-md"
                                wire:key="trabajador-{{ $index }}">

                                <div class="flex items-center justify-between mb-4">
                                    <span
                                        class="text-[10px] font-black uppercase tracking-widest text-[#07CBBB]">Trabajador
                                        {{ $index + 1 }}</span>

                                    {{-- Botón Eliminar --}}
                                    <button type="button" wire:click="quitarTrabajador({{ $index }})"
                                        class="text-slate-300 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-400 transition-colors">
                                        <i class="fa-solid fa-circle-xmark text-lg"></i>
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                                    <!-- Nombre del Técnico -->
                                    <div class="md:col-span-6 space-y-2">
                                        <label
                                            class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-gray-300 ml-1">Nombre
                                            del técnico</label>
                                        <div class="relative">
                                            <input type="text" placeholder="Escribir nombre..."
                                                wire:model="{{ $formPath }}.trabajadores.{{ $index }}.nombre"
                                                class="w-full bg-white dark:bg-gray-900 border-slate-200 dark:border-gray-600 rounded-2xl py-3.5 px-4 text-sm font-semibold text-slate-700 dark:text-slate-200 focus:border-[#07CBBB] dark:focus:border-[#07CBBB] focus:ring-4 focus:ring-[#07CBBB]/5 transition-all outline-none" />
                                        </div>
                                        <x-input-error
                                            for="{{ $formPath }}.trabajadores.{{ $index }}.nombre" />
                                    </div>

                                    <!-- Entrada -->
                                    <div class="md:col-span-3 space-y-2">
                                        <label
                                            class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-gray-300 ml-1">Entrada</label>
                                        <div class="relative">
                                            <input type="time"
                                                wire:model="{{ $formPath }}.trabajadores.{{ $index }}.entrada"
                                                class="w-full bg-white dark:bg-gray-900 border-slate-200 dark:border-gray-600 rounded-2xl py-3.5 px-4 text-sm font-semibold text-slate-700 dark:text-slate-200 focus:border-[#07CBBB] focus:ring-4 focus:ring-[#07CBBB]/5 transition-all outline-none [color-scheme:light] dark:[color-scheme:dark]" />
                                            <div
                                                class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400 dark:text-gray-400">
                                                <i class="fa-regular fa-clock text-xs"></i>
                                            </div>
                                        </div>
                                        <x-input-error
                                            for="{{ $formPath }}.trabajadores.{{ $index }}.entrada" />
                                    </div>

                                    <!-- Salida -->
                                    <div class="md:col-span-3 space-y-2">
                                        <label
                                            class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-gray-300 ml-1">Salida</label>
                                        <div class="relative">
                                            <input type="time"
                                                wire:model="{{ $formPath }}.trabajadores.{{ $index }}.salida"
                                                class="w-full bg-white dark:bg-gray-900 border-slate-200 dark:border-gray-600 rounded-2xl py-3.5 px-4 text-sm font-semibold text-slate-700 dark:text-slate-200 focus:border-[#07CBBB] focus:ring-4 focus:ring-[#07CBBB]/5 transition-all outline-none [color-scheme:light] dark:[color-scheme:dark]" />
                                            <div
                                                class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400 dark:text-gray-400">
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
                            class="w-full py-4 border-2 border-dashed border-slate-200 dark:border-gray-600 rounded-2xl text-slate-400 dark:text-gray-400 font-bold text-sm hover:border-[#07CBBB] dark:hover:border-[#07CBBB] hover:text-[#07CBBB] hover:bg-[#07CBBB]/5 transition-all flex items-center justify-center gap-2">
                            <i class="fa-solid fa-plus text-xs"></i>
                            Añadir trabajador
                        </button>
                    </div>

                </div>
                
                <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-gray-700 mt-6 transition-colors">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-1.5 bg-[#07CBBB] rounded-full"></div>
                            <h3 class="text-lg font-bold text-slate-800 dark:text-white tracking-tight uppercase transition-colors">Materiales</h3>
                        </div>
                        <i class="fa-solid fa-chevron-down text-slate-400 dark:text-gray-400 text-sm"></i>
                    </div>

                    <div class="space-y-6">
                        @foreach ($isEditing ? $updateForm->materiales : $createForm->materiales as $index => $material)
                            <div class="p-5 rounded-2xl bg-slate-50/50 dark:bg-gray-800/50 border border-slate-100 dark:border-gray-600/50 relative group transition-all hover:bg-white dark:hover:bg-slate-800 hover:shadow-md"
                                wire:key="material-{{ $index }}">

                                <div class="flex items-center justify-between mb-4">
                                    <span
                                        class="text-[10px] font-black uppercase tracking-widest text-[#07CBBB]">Material
                                        {{ $index + 1 }}</span>

                                    <button type="button" wire:click="quitarMaterial({{ $index }})"
                                        class="text-slate-300 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-400 transition-colors">
                                        <i class="fa-solid fa-circle-xmark text-lg"></i>
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                                    <div class="{{ empty($material['material_id']) ? 'md:col-span-4' : 'md:col-span-8' }} space-y-2">
                                        <label
                                            class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-gray-300 ml-1">Seleccionar Material</label>
                                        <div class="relative">
                                            <select wire:model.live="{{ $formPath }}.materiales.{{ $index }}.material_id"
                                                class="w-full bg-white dark:bg-gray-900 border-slate-200 dark:border-gray-600 rounded-2xl py-3.5 px-4 text-sm font-semibold text-slate-700 dark:text-slate-200 focus:border-[#07CBBB] focus:ring-4 focus:ring-[#07CBBB]/5 transition-all outline-none">
                                                <option value="">Ocasional (escribir nombre)</option>
                                                @foreach ($materialesDisponibles as $md)
                                                    <option value="{{ $md->id }}">{{ $md->nombre }} (Stock: {{ $md->cantidad }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    @if(empty($material['material_id']))
                                        <div class="md:col-span-4 space-y-2">
                                            <label
                                                class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-gray-300 ml-1">Nombre (Ocasional)</label>
                                            <input type="text" placeholder="Escribir material..."
                                                wire:model="{{ $formPath }}.materiales.{{ $index }}.material_ocasional"
                                                class="w-full bg-white dark:bg-gray-900 border-slate-200 dark:border-gray-600 rounded-2xl py-3.5 px-4 text-sm font-semibold text-slate-700 dark:text-slate-200 focus:border-[#07CBBB] focus:ring-4 focus:ring-[#07CBBB]/5 transition-all outline-none" />
                                        </div>
                                    @endif

                                    <div class="md:col-span-4 space-y-2">
                                        <label
                                            class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-gray-300 ml-1">Cantidad</label>
                                        <input type="number" min="1"
                                            wire:model="{{ $formPath }}.materiales.{{ $index }}.cantidad"
                                            class="w-full bg-white dark:bg-gray-900 border-slate-200 dark:border-gray-600 rounded-2xl py-3.5 px-4 text-sm font-semibold text-slate-700 dark:text-slate-200 focus:border-[#07CBBB] focus:ring-4 focus:ring-[#07CBBB]/5 transition-all outline-none" />
                                        <x-input-error
                                            for="{{ $formPath }}.materiales.{{ $index }}.cantidad" />
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <button type="button" wire:click="addMaterial"
                            class="w-full py-4 border-2 border-dashed border-slate-200 dark:border-gray-600 rounded-2xl text-slate-400 dark:text-gray-400 font-bold text-sm hover:border-[#07CBBB] dark:hover:border-[#07CBBB] hover:text-[#07CBBB] hover:bg-[#07CBBB]/5 transition-all flex items-center justify-center gap-2">
                            <i class="fa-solid fa-plus text-xs"></i>
                            Añadir material
                        </button>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-gray-700 mt-6 transition-colors">
                    <!-- Encabezado con línea decorativa corporativa -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-1.5 bg-[#07CBBB] rounded-full"></div>
                            <h3 class="text-lg font-bold text-slate-800 dark:text-white tracking-tight uppercase transition-colors">Tipo de Trabajo</h3>
                        </div>
                        <i class="fa-solid fa-chevron-down text-slate-400 dark:text-gray-400 text-sm"></i>
                    </div>

                    <div class="space-y-8">
                        <!-- Grid de Radio Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <!-- Opción: Incidencia -->
                            <label class="relative flex cursor-pointer">
                                <input type="radio" wire:model="{{ $formPath }}.tipo_trabajo"
                                    value="incidencia" class="peer sr-only" name="tipo_trabajo">
                                <div
                                    class="w-full flex items-center justify-center gap-3 p-4 bg-slate-50 dark:bg-gray-800 border-2 border-slate-100 dark:border-gray-600 rounded-2xl transition-all peer-checked:border-[#07CBBB] peer-checked:bg-[#07CBBB]/5 peer-checked:dark:bg-[#07CBBB]/10 peer-checked:shadow-sm group">
                                    <span class="text-xl group-hover:scale-110 transition-transform">⚠️</span>
                                    <span
                                        class="text-sm font-bold text-slate-600 dark:text-gray-200 peer-checked:text-[#07CBBB] peer-checked:dark:text-[#07CBBB]">Incidencia</span>

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
                                    class="w-full flex items-center justify-center gap-3 p-4 bg-slate-50 dark:bg-gray-800 border-2 border-slate-100 dark:border-gray-600 rounded-2xl transition-all peer-checked:border-[#07CBBB] peer-checked:bg-[#07CBBB]/5 peer-checked:dark:bg-[#07CBBB]/10 peer-checked:shadow-sm group">
                                    <span class="text-xl group-hover:scale-110 transition-transform">📋</span>
                                    <span
                                        class="text-sm font-bold text-slate-600 dark:text-gray-200 peer-checked:text-[#07CBBB] peer-checked:dark:text-[#07CBBB]">Visita</span>

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
                                class="inline-block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-gray-300 ml-1 group-focus-within:text-slate-800 dark:group-focus-within:text-white transition-colors">
                                Trabajos Realizados
                            </label>
                            <div class="relative">
                                <textarea wire:model="{{ $formPath }}.descripcion" rows="4"
                                    placeholder="Describe detalladamente los trabajos realizados..."
                                    class="w-full bg-slate-50 dark:bg-gray-800 border-slate-200 dark:border-gray-600 rounded-2xl py-4 px-5 text-sm font-semibold text-slate-700 dark:text-slate-200 placeholder:text-slate-400 dark:placeholder:text-slate-500 placeholder:font-normal focus:bg-white dark:focus:bg-slate-900 focus:border-[#07CBBB] focus:ring-4 focus:ring-[#07CBBB]/5 transition-all outline-none resize-none"></textarea>

                                <!-- Decoración en la esquina inferior para el textarea -->
                                <div class="absolute bottom-3 right-4 pointer-events-none opacity-20">
                                    <i class="fa-solid fa-pen-nib text-xs text-slate-400 dark:text-gray-400"></i>
                                </div>
                            </div>
                            <x-input-error for="{{ $formPath }}.descripcion" class="mt-1 ml-1" />
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN: ESTADO Y VINCULACIONES -->
                <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-gray-700 mt-6 transition-colors">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-1.5 bg-[#07CBBB] rounded-full"></div>
                            <h3 class="text-lg font-black text-slate-800 dark:text-white tracking-widest uppercase transition-colors">Estado y Vinculaciones</h3>
                        </div>
                        <i class="fa-solid fa-chevron-down text-slate-400 dark:text-gray-400 text-sm"></i>
                    </div>

                    <div class="space-y-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-gray-400 ml-1">Estado del Albarán</label>
                            <div class="grid grid-cols-3 gap-3">
                                @foreach (['pendiente', 'entregado', 'retirado'] as $est)
                                    <label class="relative cursor-pointer group text-center">
                                        <input type="radio" wire:model="{{ $formPath }}.estado" value="{{ $est }}" class="peer sr-only">
                                        <div class="p-4 rounded-2xl border-2 border-slate-100 dark:border-gray-700 bg-slate-50/50 dark:bg-gray-800/50 transition-all peer-checked:border-slate-800 dark:peer-checked:border-white peer-checked:bg-slate-800 dark:peer-checked:bg-white peer-checked:text-white dark:peer-checked:text-slate-900 text-slate-600 dark:text-gray-300">
                                            <p class="text-[10px] font-black uppercase tracking-widest">{{ $est }}</p>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-slate-50/50 dark:bg-gray-800/50 rounded-[2rem] p-6 border border-slate-100 dark:border-gray-700 transition-colors">
                            <div class="flex justify-between items-center mb-4 px-2">
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-gray-400">
                                    Móviles Vinculados
                                </span>
                                <button type="button" wire:click="$toggle('showMovilModal')"
                                    class="text-xs font-black text-[#07CBBB] uppercase tracking-widest hover:underline">
                                    + Añadir
                                </button>
                            </div>

                            @if ($showMovilModal)
                                <div class="relative animate-in slide-in-from-top-2">
                                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar por IMEI..."
                                        class="w-full mb-2 p-3.5 border-2 border-slate-200 dark:border-gray-600 bg-white dark:bg-gray-900 rounded-2xl text-sm font-semibold text-slate-700 dark:text-slate-200 outline-none focus:border-[#07CBBB] transition-all">
                                    
                                    @if (count($search_results) > 0)
                                        <div class="absolute z-50 w-full bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-600 rounded-2xl shadow-xl max-h-40 overflow-auto mb-4">
                                            @foreach ($search_results as $res)
                                                <div wire:click="addMovil({{ $res->id }})"
                                                    class="p-3 hover:bg-[#07CBBB]/10 dark:hover:bg-[#07CBBB]/20 cursor-pointer text-xs font-bold text-slate-700 dark:text-slate-200 transition-colors">
                                                    {{ $res->codigo }}
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <div class="grid grid-cols-1 gap-2 mt-4">
                                @foreach ($movilesSeleccionados as $m)
                                    <div class="flex justify-between items-center bg-white dark:bg-gray-900 p-4 rounded-2xl border border-slate-100 dark:border-gray-600 shadow-sm transition-all hover:shadow-md">
                                        <span class="text-xs font-black italic text-slate-700 dark:text-gray-200 tracking-tighter">{{ $m->codigo }}</span>
                                        <button wire:click="quitarMovil({{ $m->id }})" class="text-rose-400 hover:text-rose-600 font-bold p-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                                <x-input-error for="{{ $formPath }}.moviles_ids" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ═══════════════════════════════════════════ -->
                <!-- SECCIÓN DE FIRMAS                          -->
                <!-- ═══════════════════════════════════════════ -->
                    <div class="bg-white dark:bg-gray-900 p-6 sm:p-8 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-gray-700 mt-8 transition-colors"
                        x-data="{
                            firmaSavian: '',
                            firmaCliente: '',

                            init() {
                                this.loadFirmas();
                                this.$watch('$wire.openCrear', (val) => {
                                    if (val) {
                                        setTimeout(() => this.loadFirmas(), 300);
                                    } else {
                                        this.firmaSavian = '';
                                        this.firmaCliente = '';
                                    }
                                });

                                window.addEventListener('firma-guardada', (e) => {
                                    const f = $wire.get('isEditing') ? 'updateForm' : 'createForm';
                                    if (e.detail.tipo === 'savian') {
                                        this.firmaSavian = e.detail.dataUrl;
                                        $wire.set(f + '.firma_trabajador', e.detail.dataUrl);
                                    } else {
                                        this.firmaCliente = e.detail.dataUrl;
                                        $wire.set(f + '.firma_cliente', e.detail.dataUrl);
                                    }
                                });
                            },

                            loadFirmas() {
                                const editing = $wire.get('isEditing');
                                const f = editing ? 'updateForm' : 'createForm';
                                this.firmaSavian = $wire.get(f + '.firma_trabajador') || '';
                                this.firmaCliente = $wire.get(f + '.firma_cliente') || '';
                            },

                            abrirFirma(tipo) {
                                window._firmaOverlay.abrir(tipo);
                            },

                            borrarFirma(tipo) {
                                const f = $wire.get('isEditing') ? 'updateForm' : 'createForm';
                                if (tipo === 'savian') {
                                    this.firmaSavian = '';
                                    $wire.set(f + '.firma_trabajador', '');
                                } else {
                                    this.firmaCliente = '';
                                    $wire.set(f + '.firma_cliente', '');
                                }
                            }
                        }">

                        <!-- Título -->
                        <div class="flex items-center gap-3 mb-6 sm:mb-8">
                            <div class="h-8 w-1.5 bg-[#07CBBB] rounded-full"></div>
                            <h3 class="text-lg font-black text-[#07CBBB] tracking-tight uppercase">Firmas</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                            <!-- Cuadro Firma Representante -->
                            <div class="flex flex-col items-center">
                                <button type="button" @click="abrirFirma('savian')"
                                    class="relative w-full h-40 sm:h-44 bg-white dark:bg-gray-800 border-2 border-dashed border-slate-200 dark:border-gray-600 rounded-3xl overflow-hidden group hover:border-[#07CBBB]/40 dark:hover:border-[#07CBBB]/40 transition-all shadow-inner flex flex-col items-center justify-center cursor-pointer">
                                    <template x-if="firmaSavian">
                                        <img :src="firmaSavian" class="max-h-full max-w-full p-3 object-contain dark:invert">
                                    </template>
                                    <template x-if="!firmaSavian">
                                        <div class="flex flex-col items-center pointer-events-none">
                                            <span class="text-slate-500 dark:text-gray-300 font-black text-[10px] sm:text-[11px] uppercase tracking-[0.15em] sm:tracking-[0.2em]">Representante Savian</span>
                                            <span class="text-slate-400 dark:text-gray-400 text-[9px] font-bold mt-2 opacity-60">Toca para firmar</span>
                                        </div>
                                    </template>
                                </button>
                                <button x-show="firmaSavian" x-cloak type="button" @click="borrarFirma('savian')"
                                    class="mt-3 text-red-500 text-[10px] font-black uppercase tracking-widest hover:underline">
                                    Borrar firma
                                </button>
                            </div>

                            <!-- Cuadro Firma Cliente -->
                            <div class="flex flex-col items-center">
                                <button type="button" @click="abrirFirma('cliente')"
                                    class="relative w-full h-40 sm:h-44 bg-white dark:bg-gray-800 border-2 border-dashed border-slate-200 dark:border-gray-600 rounded-3xl overflow-hidden group hover:border-[#07CBBB]/40 dark:hover:border-[#07CBBB]/40 transition-all shadow-inner flex flex-col items-center justify-center cursor-pointer">
                                    <template x-if="firmaCliente">
                                        <img :src="firmaCliente" class="max-h-full max-w-full p-3 object-contain dark:invert">
                                    </template>
                                    <template x-if="!firmaCliente">
                                        <div class="flex flex-col items-center pointer-events-none">
                                            <span class="text-slate-500 dark:text-gray-300 font-black text-[10px] sm:text-[11px] uppercase tracking-[0.15em] sm:tracking-[0.2em]">Cliente</span>
                                            <span class="text-slate-400 dark:text-gray-400 text-[9px] font-bold mt-2 opacity-60">Toca para firmar</span>
                                        </div>
                                    </template>
                                </button>
                                <button x-show="firmaCliente" x-cloak type="button" @click="borrarFirma('cliente')"
                                    class="mt-3 text-red-500 text-[10px] font-black uppercase tracking-widest hover:underline">
                                    Borrar firma
                                </button>
                            </div>
                        </div>

                        <!-- Texto Legal -->
                        <div class="pt-6 sm:pt-8 border-t border-slate-100 dark:border-gray-700 mt-8 sm:mt-10">
                            <p class="text-[10px] text-slate-400 dark:text-gray-400 leading-relaxed text-justify font-medium italic opacity-80">
                                Con la firma de este documento, el cliente reconoce haber sido informado de los trabajos realizados y/o de la entrega o retirada de los dispositivos mencionados en las condiciones especificadas anteriormente. *En caso de entrega, el cliente reconoce haber recibido los dispositivos mencionados, asumiendo la responsabilidad de su uso, conservación y devolución en las condiciones establecidas por Savian.
                            </p>
                        </div>
                    </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex gap-3 w-full sm:w-auto">
                <button wire:click="cerrarModal"
                    class="flex-1 sm:flex-none px-6 py-4 sm:py-3 text-[10px] font-black uppercase text-slate-400 dark:text-gray-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                    Cancelar
                </button>
                <button wire:click="save" wire:loading.attr="disabled"
                    class="flex-1 sm:flex-none px-10 py-4 bg-slate-800 dark:bg-[#07CBBB] hover:bg-black dark:hover:bg-[#05968b] text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-slate-200 dark:shadow-none transition-all hover:-translate-y-1">
                    <span wire:loading.remove>{{ $isEditing ? 'Guardar Cambios' : 'Generar Albarán' }}</span>
                    <span wire:loading>Procesando...</span>
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
