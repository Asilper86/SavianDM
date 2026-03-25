<div
    x-data="{
        open: @entangle('openCrear'),
        init() {
            this.$watch('open', value => {
                document.body.style.overflow = value ? 'hidden' : 'auto';
            });
        }
    }"
    class="relative"
>
    <button
        @click="open = true"
        class="bg-[#07B8AA] hover:bg-[#06968a] text-white font-bold px-6 py-3 rounded-full transition-all flex items-center gap-2 text-sm shadow-md active:scale-95"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-width="2.5" d="M12 4v16m8-8H4" />
        </svg>
        Nuevo Registro
    </button>

    <!-- Overlay + panel -->
    <div
        x-show="open"
        x-cloak
        class="fixed inset-0 z-[9999]"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true"
    >
        <!-- Fondo -->
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="open = false"
            class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"
        ></div>

        <!-- Contenedor lateral -->
        <div class="absolute inset-y-0 right-0 flex max-w-full">
            <div
                x-show="open"
                x-transition:enter="transform transition ease-out duration-300"
                x-transition:enter-start="translate-x-full opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transform transition ease-in duration-200"
                x-transition:leave-start="translate-x-0 opacity-100"
                x-transition:leave-end="translate-x-full opacity-0"
                class="relative w-screen max-w-md bg-white shadow-2xl h-screen md:h-[100dvh] flex flex-col border-l border-slate-200"
            >
                <!-- Cabecera -->
                <div class="px-8 py-6 flex items-center justify-between border-b border-slate-100 bg-white">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-2xl bg-[#07B8AA]/10 text-[#07B8AA] flex items-center justify-center shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <div>
                            <h3 id="modal-title" class="text-xl font-extrabold text-slate-800 tracking-tight">
                                Nuevo Dispositivo
                            </h3>
                            <p class="text-[10px] text-[#07B8AA] font-bold uppercase tracking-[0.2em]">
                                SavianRobotics Inventory
                            </p>
                        </div>
                    </div>

                    <button
                       wire:click="cancelar"
                        class="p-2 rounded-full hover:bg-red-50 text-slate-400 hover:text-red-500 transition-all"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Contenido -->
                <div class="flex-1 px-8 py-6 space-y-5 overflow-y-auto custom-scrollbar bg-slate-50/40">
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">
                            Código Identificador
                        </label>
                        <input
                            wire:model="cform.codigo"
                            type="text"
                            placeholder="Ej: SR-2024-001"
                            class="w-full bg-white border border-slate-200 rounded-2xl py-3.5 px-5 text-sm font-semibold text-slate-700 focus:ring-4 focus:ring-[#07B8AA]/10 focus:border-[#07B8AA] outline-none transition-all"
                        >
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">
                                Tipo Compra
                            </label>
                            <select
                                wire:model="cform.tipoCompra"
                                class="w-full bg-white border border-slate-200 rounded-2xl py-3.5 px-4 text-sm font-semibold text-slate-700 outline-none focus:ring-4 focus:ring-[#07B8AA]/10 focus:border-[#07B8AA]"
                            >
                                <option value="">Elegir...</option>
                                <option value="Propio">Propio</option>
                                <option value="Alquilado">Alquilado</option>
                            </select>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">
                                Estado
                            </label>
                            <select
                                wire:model="cform.estado"
                                class="w-full bg-white border border-slate-200 rounded-2xl py-3.5 px-4 text-sm font-semibold text-slate-700 outline-none focus:ring-4 focus:ring-[#07B8AA]/10 focus:border-[#07B8AA]"
                            >
                                <option value="">Elegir...</option>
                                <option value="Stock">Stock</option>
                                <option value="Roto">Roto</option>
                                <option value="Campo">Campo</option>
                                <option value="Preparado">Preparado</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">
                            Modelo
                        </label>
                        <select
                            wire:model="cform.modelo_id"
                            class="w-full bg-white border border-slate-200 rounded-2xl py-3.5 px-5 text-sm font-semibold text-slate-700 outline-none focus:ring-4 focus:ring-[#07B8AA]/10 focus:border-[#07B8AA]"
                        >
                            <option value="">Selecciona un modelo...</option>
                            @foreach ( $modelo as $item )
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                            
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">
                            Empresa Asignada
                        </label>
                        <select
                            wire:model="cform.empresa_id"
                            class="w-full bg-white border border-slate-200 rounded-2xl py-3.5 px-5 text-sm font-semibold text-slate-700 outline-none focus:ring-4 focus:ring-[#07B8AA]/10 focus:border-[#07B8AA]"
                        >
                            <option value="">Selecciona empresa...</option>
                            @foreach ( $empresa as $item )
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">
                            Proveedor
                        </label>
                        <select
                            wire:model="cform.proveedor_id"
                            class="w-full bg-white border border-slate-200 rounded-2xl py-3.5 px-5 text-sm font-semibold text-slate-700 outline-none focus:ring-4 focus:ring-[#07B8AA]/10 focus:border-[#07B8AA]"
                        >
                            <option value="">Selecciona proveedor...</option>
                            @foreach ( $proveedor as $item )
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-8 py-11 bg-white border-t border-slate-100 flex items-center justify-between">
                    <button
                        wire:click="cancelar"
                        type="button"
                        class="text-[11px] font-black text-slate-400 hover:text-red-500 uppercase tracking-widest transition-all"
                    >
                        Cancelar
                    </button>

                    <button
                        wire:click="crearMovil"
                        class="bg-slate-900 hover:bg-[#07B8AA] text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg flex items-center gap-3 transition-all active:scale-95"
                    >
                        <span>Guardar</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
    </style>
</div>