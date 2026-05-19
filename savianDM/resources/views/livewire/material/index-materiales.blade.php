<div class="w-full min-h-screen bg-[#F3F4F6] p-4 md:p-8 flex flex-col">
    <div
        class="bg-white/80 backdrop-blur-xl rounded-[3.5rem] shadow-[0_20px_60px_rgba(0,0,0,0.03)] border border-white p-6 sm:p-10 flex-1 flex flex-col">

        <div class="flex flex-col gap-6 sm:gap-8 mb-8 sm:mb-10 px-1 sm:px-4">
            <div class="flex flex-row justify-between items-center sm:items-end gap-2 sm:gap-4">
                <div>
                    <div class="flex items-center gap-2 sm:gap-4 mb-1 sm:mb-2">
                        <span class="hidden sm:block w-8 sm:w-10 h-1.5 bg-[#07CBBB] rounded-full"></span>
                        <h3 class="text-xl sm:text-4xl font-black text-slate-800 tracking-tighter">Gestión de Materiales</h3>
                    </div>
                    <p class="hidden sm:block text-slate-400 text-xs sm:text-base font-medium sm:ml-14">Control de stock de materiales del almacén.</p>
                </div>
                <div class="shrink-0">
                    @livewire('material.create-material')
                </div>
            </div>

            <div
                class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-slate-50/50 p-4 rounded-[2rem] border border-slate-100">
                <div class="relative">
                    <input wire:model.live="buscar" type="text" placeholder="Buscar nombre..."
                        class="w-full bg-white border-none rounded-2xl py-3 px-5 text-sm font-bold shadow-sm focus:ring-2 focus:ring-cyan-100 outline-none">
                </div>
                
                <button wire:click="limpiarFiltros"
                    class="bg-slate-800 text-white rounded-2xl font-bold text-sm hover:bg-black transition-all md:col-start-3">Limpiar
                    Filtros</button>
            </div>
        </div>
        @if ($materiales->count())
            <div class="overflow-x-auto flex-1">
                <table class="w-full border-separate border-spacing-y-4">
                    <thead>
                        <tr>
                            <th class="px-4 sm:px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-left whitespace-nowrap">ID</th>
                            <th class="px-4 sm:px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-left whitespace-nowrap">Nombre</th>
                            <th class="px-4 sm:px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-center whitespace-nowrap">Stock (Cantidad)</th>
                            <th class="px-4 sm:px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-left whitespace-nowrap">Descripción</th>
                            <th class="px-4 sm:px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-right whitespace-nowrap">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materiales as $item)
                            <tr class="group">
                                <td
                                    class="bg-slate-50/50 group-hover:bg-white px-4 sm:px-6 py-4 sm:py-5 rounded-l-[1.5rem] sm:rounded-l-[2rem] transition-all border-y border-l border-transparent group-hover:border-slate-100 text-sm font-black text-slate-700 whitespace-nowrap">
                                    {{ $item->id }}
                                </td>
                                <td
                                    class="bg-slate-50/50 group-hover:bg-white px-4 sm:px-6 py-4 sm:py-5 transition-all border-y border-transparent group-hover:border-slate-100 font-bold text-slate-600 whitespace-nowrap">
                                    {{ $item->nombre }}
                                </td>
                                <td
                                    class="bg-slate-50/50 group-hover:bg-white px-4 sm:px-6 py-4 sm:py-5 transition-all border-y border-transparent group-hover:border-slate-100 text-center whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center justify-center px-3 py-1.5 rounded-xl text-xs font-black {{ $item->cantidad > 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600' }}">
                                        {{ $item->cantidad }}
                                    </span>
                                </td>
                                <td
                                    class="bg-slate-50/50 group-hover:bg-white px-4 sm:px-6 py-4 sm:py-5 transition-all border-y border-transparent group-hover:border-slate-100 text-xs font-medium text-slate-400">
                                    {{ Str::limit($item->descripcion, 50) }}
                                </td>
                                <td
                                    class="bg-slate-50/50 group-hover:bg-white px-4 sm:px-6 py-4 sm:py-5 rounded-r-[1.5rem] sm:rounded-r-[2rem] transition-all border-y border-r border-transparent group-hover:border-slate-100 text-right whitespace-nowrap">
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
                {{ $materiales->links() }}
            </div>
        @else
            <x-mios.advertencia>
                No se encontraron materiales o todavía no se ha creado ninguno.
            </x-mios.advertencia>
        @endif
    </div>

    <!------------------------------------ Modal para update  ------------------------------------------>
    @if ($uform->material)
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
                        <h3 class="text-2xl font-black text-slate-800 tracking-tight">Editar Material</h3>
                    </div>
                </div>
            </x-slot>

            <x-slot name="content">
                <div class="px-4 pb-6 space-y-6">
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Nombre del Material</label>
                        <input wire:model="uform.nombre" type="text"
                            class="w-full bg-slate-50 border border-slate-200 rounded-[1.2rem] py-3 px-5 text-sm font-bold focus:ring-4 focus:ring-[#07B8AA]/10 focus:border-[#07B8AA] outline-none transition-all text-slate-700">
                        <x-input-error for="uform.nombre" class="mt-1 ml-1" />
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Stock (Cantidad)</label>
                        <input wire:model="uform.cantidad" type="number"
                            class="w-full bg-slate-50 border border-slate-200 rounded-[1.2rem] py-3 px-5 text-sm font-bold focus:ring-4 focus:ring-[#07B8AA]/10 focus:border-[#07B8AA] outline-none transition-all text-slate-700">
                        <x-input-error for="uform.cantidad" class="mt-1 ml-1" />
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Descripción</label>
                        <textarea wire:model="uform.descripcion" rows="3"
                            class="w-full bg-slate-50 border border-slate-200 rounded-[1.2rem] py-3 px-5 text-sm font-bold focus:ring-4 focus:ring-[#07B8AA]/10 focus:border-[#07B8AA] outline-none transition-all text-slate-700"></textarea>
                        <x-input-error for="uform.descripcion" class="mt-1 ml-1" />
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex items-center justify-between w-full px-4 pb-4">
                    <button wire:click="cancelar" type="button"
                        class="text-[11px] font-black text-slate-400 hover:text-red-500 uppercase tracking-[0.2em] transition-all">
                        Descartar Cambios
                    </button>

                    <button wire:click="actualizarMaterial" wire:loading.attr="disabled"
                        class="bg-[#111827] hover:bg-[#07B8AA] text-white font-bold px-10 py-4 rounded-[1.2rem] shadow-xl hover:shadow-[#07B8AA]/20 flex items-center gap-3 transition-all active:scale-95 group">
                        <span wire:loading.remove wire:target="actualizarMaterial">Actualizar Registro</span>
                        <span wire:loading wire:target="actualizarMaterial" class="text-xs">Guardando...</span>
                    </button>
                </div>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>
