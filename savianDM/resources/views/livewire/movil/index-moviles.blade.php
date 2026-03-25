<div class="w-full min-h-screen bg-[#F3F4F6] p-4 md:p-8 flex flex-col">
    <div
        class="bg-white/80 backdrop-blur-xl rounded-[3.5rem] shadow-[0_20px_60px_rgba(0,0,0,0.03)] border border-white p-6 sm:p-10 flex-1 flex flex-col">

        <div class="flex flex-col gap-8 mb-10 px-4">
            <div class="flex justify-between items-end">
                <div>
                    <div class="flex items-center gap-4 mb-2">
                        <span class="w-10 h-1.5 bg-[#07CBBB] rounded-full"></span>
                        <h3 class="text-4xl font-black text-slate-800 tracking-tighter">Gestión de Móviles</h3>
                    </div>
                    <p class="text-slate-400 text-base font-medium ml-14">Control de inventario y estado de
                        dispositivos.</p>
                </div>
                @livewire('movil.create-movil')
            </div>

            <div
                class="grid grid-cols-1 md:grid-cols-4 gap-4 bg-slate-50/50 p-4 rounded-[2rem] border border-slate-100">
                <div class="relative">
                    <input wire:model.live="buscar" type="text" placeholder="Buscar SN..."
                        class="w-full bg-white border-none rounded-2xl py-3 px-5 text-sm font-bold shadow-sm focus:ring-2 focus:ring-cyan-100 outline-none">
                </div>
                <select wire:model.live="idEmpresa"
                    class="bg-white border-none rounded-2xl py-3 px-5 text-sm font-bold shadow-sm focus:ring-2 focus:ring-cyan-100 outline-none appearance-none">
                    <option value="">Empresa</option>
                    @foreach ($empresa as $item)
                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                    @endforeach
                </select>

                <button wire:click="limpiarFiltros"
                    class="bg-slate-800 text-white rounded-2xl font-bold text-sm hover:bg-black transition-all">Limpiar
                    Filtros</button>
            </div>
        </div>
        @if ($moviles->count())
            <div class="overflow-x-auto flex-1">
                <table class="w-full border-separate border-spacing-y-4">
                    <thead>
                        <tr class="text-slate-400">
                            <th class="px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-left">SN</th>
                            <th class="px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-left">Tipo Compra
                            </th>
                            <th class="px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-left">Modelo</th>
                            <th class="px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-left">Empresa</th>
                            <th class="px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-center">Estado</th>
                            <th class="px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-left">Proveedor</th>
                            <th class="px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($moviles as $item)
                            <tr class="group">
                                <td
                                    class="bg-slate-50/50 group-hover:bg-white px-6 py-5 rounded-l-[2rem] transition-all border-y border-l border-transparent group-hover:border-slate-100 text-sm font-black text-slate-700">
                                    {{ $item->codigo }}
                                </td>
                                <td
                                    class="bg-slate-50/50 group-hover:bg-white px-6 py-5 transition-all border-y border-transparent group-hover:border-slate-100">
                                    <span
                                        class="px-3 py-1.5 rounded-xl text-[10px] font-black uppercase {{ $item->tipo_compra == 'Propio' ? 'bg-blue-50 text-blue-500' : 'bg-indigo-50 text-indigo-500' }}">
                                        {{ $item->tipoCompra }}
                                    </span>
                                </td>
                                <td
                                    class="bg-slate-50/50 group-hover:bg-white px-6 py-5 transition-all border-y border-transparent group-hover:border-slate-100 font-bold text-slate-600">
                                    {{ $item->modelo->nombre }}
                                </td>
                                <td
                                    class="bg-slate-50/50 group-hover:bg-white px-6 py-5 transition-all border-y border-transparent group-hover:border-slate-100 font-bold text-slate-500">
                                    {{ $item->empresa->nombre }}
                                </td>
                                <td
                                    class="bg-slate-50/50 group-hover:bg-white px-6 py-5 transition-all border-y border-transparent group-hover:border-slate-100 text-center">
                                    @php
                                        // Definimos los colores para cada estado
                                        $config = match ($item->estado) {
                                            'Stock' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'dot' => 'bg-emerald-500'],
                                            'Roto' => ['bg' => 'bg-red-50', 'text' => 'text-red-600', 'dot' => 'bg-red-500'],
                                            'Campo' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'dot' => 'bg-blue-500'],
                                            'Preparado' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'dot' => 'bg-amber-500'],
                                            default => ['bg' => 'bg-slate-50', 'text' => 'text-slate-600', 'dot' => 'bg-slate-500'],
                                        };
                                    @endphp

                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black uppercase {{ $config['bg'] }} {{ $config['text'] }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $config['dot'] }}"></span>
                                        {{ $item->estado }}
                                    </span>
                                </td>
                                <td
                                    class="bg-slate-50/50 group-hover:bg-white px-6 py-5 transition-all border-y border-transparent group-hover:border-slate-100 text-xs font-medium text-slate-400">
                                    {{ $item->proveedor->nombre }}
                                </td>
                                <td
                                    class="bg-slate-50/50 group-hover:bg-white px-6 py-5 rounded-r-[2rem] transition-all border-y border-r border-transparent group-hover:border-slate-100 text-right">
                                    <div class="flex justify-end gap-2 opacity-30 group-hover:opacity-100 transition-all">
                                        <button wire:click="editar({{ $item->id }})"
                                            class="p-2.5 bg-white text-slate-400 hover:text-[#07CBBB] rounded-xl shadow-sm border border-slate-50 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>
                                        <button wire:click="mostrarMensajeBorrar({{ $item->id }})"
                                            class="p-2.5 bg-white text-slate-400 hover:text-red-500 rounded-xl shadow-sm border border-slate-50 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $moviles->links() }}
            </div>
        @else
            <x-mios.advertencia>
                No se encuentra este movil o todavia no se ha creado
            </x-mios.advertencia>
        @endif
    </div>
    <!------------------------------------ Modal para update  ------------------------------------------>
    @if ($uform->movil)
        <x-dialog-modal wire:model="openEditar" maxWidth="2xl">
            <x-slot name="title">
                <div class="flex items-center gap-4 p-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-[#E4F4F3] text-[#07CBBB] flex items-center justify-center shadow-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-slate-800 tracking-tight">Editar Dispositivo</h3>

                    </div>
                </div>
            </x-slot>

            <x-slot name="content">
                <div class="px-4 pb-6 space-y-6">
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Código
                            Identificador</label>
                        <input wire:model="uform.codigo" type="text"
                            class="w-full bg-slate-50 border border-slate-200 rounded-[1.2rem] py-3 px-5 text-sm font-bold focus:ring-4 focus:ring-[#07B8AA]/10 focus:border-[#07B8AA] outline-none transition-all text-slate-700">
                        <x-input-error for="uform.codigo" class="mt-1 ml-1" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Tipo de
                                Compra</label>
                            <select wire:model="uform.tipoCompra"
                                class="w-full bg-slate-50 border border-slate-200 rounded-[1.2rem] py-3 px-4 text-sm font-bold outline-none focus:ring-4 focus:ring-[#07B8AA]/10 focus:border-[#07B8AA] text-slate-700">
                                <option value="">Seleccionar...</option>
                                <option value="Propio">Propio</option>
                                <option value="Alquilado">Alquilado</option>
                            </select>
                            <x-input-error for="uform.tipoCompra" class="mt-1 ml-1" />
                        </div>

                        <div class="space-y-2">
                            <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Estado
                                Actual</label>
                            <select wire:model="uform.estado"
                                class="w-full bg-slate-50 border border-slate-200 rounded-[1.2rem] py-3 px-4 text-sm font-bold outline-none focus:ring-4 focus:ring-[#07B8AA]/10 focus:border-[#07B8AA] text-slate-700">
                                <option value="Stock">Stock</option>
                                <option value="Roto">Roto</option>
                                <option value="Campo">Campo</option>
                                <option value="Preparado">Preparado</option>
                            </select>
                            <x-input-error for="uform.estado" class="mt-1 ml-1" />
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Modelo de
                            Dispositivo</label>
                        <select wire:model="uform.modelo_id"
                            class="w-full bg-slate-50 border border-slate-200 rounded-[1.2rem] py-3 px-5 text-sm font-bold outline-none focus:ring-4 focus:ring-[#07B8AA]/10 focus:border-[#07B8AA] text-slate-700">
                            <option value="">Selecciona el modelo...</option>
                            @foreach ($modelo as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="uform.modelo_id" class="mt-1 ml-1" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Empresa
                                Asignada</label>
                            <select wire:model="uform.empresa_id"
                                class="w-full bg-slate-50 border border-slate-200 rounded-[1.2rem] py-3 px-4 text-sm font-bold outline-none focus:ring-4 focus:ring-[#07B8AA]/10 focus:border-[#07B8AA] text-slate-700">
                                <option value="">Elegir empresa...</option>
                                @foreach ($empresa as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="uform.empresa_id" class="mt-1 ml-1" />
                        </div>

                        <div class="space-y-2">
                            <label
                                class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Proveedor</label>
                            <select wire:model="uform.proveedor_id"
                                class="w-full bg-slate-50 border border-slate-200 rounded-[1.2rem] py-3 px-4 text-sm font-bold outline-none focus:ring-4 focus:ring-[#07B8AA]/10 focus:border-[#07B8AA] text-slate-700">
                                <option value="">Elegir proveedor...</option>
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="uform.proveedor_id" class="mt-1 ml-1" />
                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex items-center justify-between w-full px-4 pb-4">
                    <button wire:click="cancelar" type="button"
                        class="text-[11px] font-black text-slate-400 hover:text-red-500 uppercase tracking-[0.2em] transition-all">
                        Descartar Cambios
                    </button>

                    <button wire:click="actualizarMovil" wire:loading.attr="disabled"
                        class="bg-[#111827] hover:bg-[#07B8AA] text-white font-bold px-10 py-4 rounded-[1.2rem] shadow-xl hover:shadow-[#07B8AA]/20 flex items-center gap-3 transition-all active:scale-95 group">
                        <span wire:loading.remove wire:target="actualizar">Actualizar Registro</span>
                        <span wire:loading wire:target="actualizar text-xs">Guardando...</span>
                        <svg wire:loading.remove wire:target="actualizar"
                            class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </button>
                </div>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>