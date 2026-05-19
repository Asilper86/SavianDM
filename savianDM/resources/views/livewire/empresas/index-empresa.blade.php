<div class="w-full min-h-screen bg-[#F3F4F6] p-2 sm:p-4 md:p-8 flex flex-col">
    <div
        class="bg-white/80 backdrop-blur-xl rounded-[2rem] sm:rounded-[3.5rem] shadow-[0_20px_60px_rgba(0,0,0,0.03)] border border-white p-4 sm:p-10 flex-1 flex flex-col overflow-hidden">

        <div class="flex flex-col lg:flex-row justify-between lg:items-center mb-6 sm:mb-8 gap-4 px-1 sm:px-2">
            <div class="flex flex-row justify-between items-center w-full lg:w-auto">
                <div>
                    <div class="flex items-center gap-2 sm:gap-3 mb-1">
                        <span class="hidden sm:block w-8 h-1 bg-[#07CBBB] rounded-full"></span>
                        <h3 class="text-xl sm:text-4xl font-black text-slate-800 tracking-tighter">Listado de Empresas</h3>
                    </div>
                    <p class="hidden sm:block text-slate-400 text-xs sm:text-sm font-medium sm:ml-11">Gestiona tus activos en tiempo real.</p>
                </div>
                <div class="lg:hidden shrink-0">
                    @livewire('empresas.create-empresas')
                </div>
            </div>
            <div class="w-full lg:flex-1 lg:max-w-md lg:mx-4">
                <input type="text" wire:model.live="buscar" placeholder="Buscar empresa por nombre..."
                    class="block w-full pl-12 pr-4 py-4 bg-slate-50/50 border-2 border-transparent rounded-2xl text-sm font-bold text-slate-700 outline-none focus:bg-white focus:border-[#07CBBB] focus:ring-4 focus:ring-[#07CBBB]/10 transition-all shadow-sm">
            </div>

            <div class="hidden lg:block shrink-0">
                @livewire('empresas.create-empresas')
            </div>
        </div>
        @if ($empresas->count())
            <div class="flex-1 overflow-auto rounded-3xl custom-scrollbar">
                <table class="w-full border-separate border-spacing-y-3">
                    <thead class="sticky top-0 bg-white/10 backdrop-blur-md z-10">
                        <tr class="text-slate-400">
                            <th class="px-4 sm:px-6 py-3 text-[10px] font-black uppercase tracking-widest text-left whitespace-nowrap">ID</th>
                            <th class="px-4 sm:px-6 py-3 text-[10px] font-black uppercase tracking-widest text-left whitespace-nowrap">Empresa
                            </th>
                            <th class="px-4 sm:px-6 py-3 text-[10px] font-black uppercase tracking-widest text-center whitespace-nowrap">Hectáreas
                            </th>
                            <th class="px-4 sm:px-6 py-3 text-[10px] font-black uppercase tracking-widest text-right whitespace-nowrap">Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empresas as $item)
                            <tr class="group">
                                <td
                                    class="bg-slate-50/50 px-4 sm:px-6 py-4 rounded-l-2xl sm:rounded-l-3xl border-y border-l border-transparent text-xs font-bold text-slate-400 whitespace-nowrap">
                                    #{{ $item->id }}</td>
                                <td
                                    class="bg-slate-50/50 px-4 sm:px-6 py-4 border-y border-transparent font-black text-slate-700 text-sm sm:text-base whitespace-nowrap">
                                    {{ $item->nombre }}</td>
                                <td class="bg-slate-50/50 px-4 sm:px-6 py-4 border-y border-transparent text-center whitespace-nowrap">
                                    <span
                                        class="px-3 py-1 bg-white rounded-xl text-[#07CBBB] text-xs font-black shadow-sm border border-slate-100">
                                        {{ $item->hectarea }} ha
                                    </span>
                                </td>
                                <td
                                    class="bg-slate-50/50 px-4 sm:px-6 py-4 rounded-r-2xl sm:rounded-r-3xl border-y border-r border-transparent text-right whitespace-nowrap">
                                    <div class="flex justify-end gap-2">
                                        <button wire:click="update({{ $item->id }})"
                                            class="p-2 bg-white text-slate-400 hover:text-[#07CBBB] rounded-lg transition-colors border border-slate-50"><svg
                                                class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                                    stroke-width="2" />
                                            </svg></button>
                                        <button wire:click="lanzarAlerta({{ $item->id }})"
                                            class="p-2 bg-white text-slate-400 hover:text-red-500 rounded-lg transition-colors border border-slate-50">
                                            <i class='fas fa-trash'></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mb-4">
                    {{ $empresas->links() }}
                </div>
            </div>
        @else
            <x-mios.advertencia>
                No se encontró ninguna empresa llamada así.
            </x-mios.advertencia>
        @endif

    </div>

    <x-dialog-modal wire:model="openEditar">
        <x-slot name="title">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 sm:w-16 sm:h-16 rounded-2xl bg-[#F0FDFA] text-[#07CBBB] flex items-center justify-center shadow-sm">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl sm:text-3xl font-black text-slate-800 tracking-tight">Editar Empresa</h3>
                    <p class="text-[9px] sm:text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">
                        Configuración de Activos</p>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-8 mt-4">
                {{-- Nombre de la Finca --}}
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nombre de la
                        Finca</label>
                    <input type="text" wire:model="uform.nombre" placeholder="Ej: Los Olivos"
                        class="w-full bg-[#F9FAFB] border-2 border-[#E5E7EB] rounded-2xl py-4 px-6 text-lg font-bold outline-none focus:border-[#07CBBB] transition-all">
                    <x-input-error for="uform.nombre" />
                </div>

                {{-- Superficie --}}
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Superficie
                        Total</label>
                    <div class="relative max-w-[200px]">
                        <input type="number" step="0.01" wire:model.defer="uform.hectarea"
                            class="w-full bg-[#F9FAFB] border-2 border-[#E5E7EB] rounded-2xl py-5 px-6 text-3xl font-black outline-none focus:border-[#07CBBB]">
                        <span
                            class="absolute right-6 top-1/2 -translate-y-1/2 text-xs font-black text-slate-300">ha</span>
                    </div>
                    <x-input-error for="uform.hectarea" />
                </div>

                {{-- Centros de Trabajo --}}
                <div class="space-y-3 pt-4 border-t border-slate-100">
                    <div class="flex items-center justify-between ml-1">
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Centros de Trabajo</label>
                            <p class="text-[10px] text-slate-400 font-medium mt-0.5">Edita o añade centros a esta empresa</p>
                        </div>
                        <button wire:click="addCentroUpdate" type="button" class="bg-[#F0FDFA] text-[#07CBBB] hover:bg-[#07CBBB] hover:text-white rounded-full w-8 h-8 flex items-center justify-center transition-all shadow-sm shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                        </button>
                    </div>

                    <div class="space-y-3 mt-4 max-h-[300px] overflow-y-auto custom-scrollbar px-1 py-1">
                        @foreach($uform->centros_trabajo as $index => $centro)
                            <div class="flex items-center gap-3 group" wire:key="update-centro-{{ $index }}">
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-300 group-focus-within:text-[#07CBBB] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    </div>
                                    <input type="text" wire:model.defer="uform.centros_trabajo.{{ $index }}.nombre" placeholder="Ej: Sede Norte" class="w-full bg-[#F9FAFB] border-2 border-[#E5E7EB] rounded-2xl py-3 pl-11 pr-5 text-sm font-bold text-slate-700 outline-none focus:border-[#07CBBB] transition-all">
                                </div>
                                @if(count($uform->centros_trabajo) > 1)
                                    <button wire:click="removeCentroUpdate({{ $index }})" type="button" class="text-slate-300 hover:text-red-500 hover:bg-red-50 p-3 rounded-2xl transition-all border-2 border-transparent hover:border-red-100 shrink-0" title="Eliminar centro">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                @else
                                    <div class="w-[52px] shrink-0"></div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex items-center justify-between w-full">
                <button wire:click="cancelar"
                    class="text-slate-400 hover:text-red-500 font-black text-[10px] uppercase tracking-widest flex items-center gap-2 transition-colors">
                    <span
                        class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm border border-slate-100">✕</span>
                    Cancelar
                </button>

                <button wire:click="editar" wire:loading.attr="disabled"
                    class="bg-[#111827] text-white font-bold px-8 py-4 rounded-2xl shadow-lg flex items-center gap-3 active:scale-95 transition-all text-sm disabled:opacity-50">
                    <span wire:loading.remove wire:target="editar">Editar Registro</span>
                    <span wire:loading wire:target="editar">Guardando...</span>
                    <svg wire:loading.remove wire:target="editar" class="w-4 h-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
