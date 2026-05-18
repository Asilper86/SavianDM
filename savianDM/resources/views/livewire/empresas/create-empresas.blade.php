<div x-data="{ open: @entangle('openCrear') }">
    <button @click="open = true" class="w-full sm:w-auto bg-[#E4F4F3] hover:bg-[#07B8AA] text-[#07B8AA] hover:text-white font-bold px-6 py-3 rounded-full transition-all flex items-center justify-center gap-2 text-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
        Añadir Empresa
    </button>

    <div x-show="open" class="fixed inset-0 z-[100] overflow-hidden" style="display: none;">
        <div x-show="open" x-transition:opacity @click="open = false" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>

        <div class="fixed inset-y-0 right-0 max-w-full sm:max-w-xl w-full flex">
            <div x-show="open" 
                 x-transition:enter="transform transition duration-500" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                 class="w-full bg-white shadow-2xl flex flex-col h-full sm:rounded-l-[3rem] overflow-hidden">
                
                <div class="p-6 sm:p-10 border-b border-slate-50">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-2xl bg-[#F0FDFA] text-[#07CBBB] flex items-center justify-center shadow-sm">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-width="1.5"/></svg>
                        </div>
                        <div>
                            <h3 class="text-xl sm:text-3xl font-black text-slate-800 tracking-tight">Nueva Empresa</h3>
                            <p class="text-[9px] sm:text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Configuración de Activos</p>
                        </div>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto p-6 sm:p-10 space-y-8 custom-scrollbar">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nombre de la Empresa</label>
                        <input type="text"  wire:model.defer="cform.nombre" placeholder="Ej: Los Olivos" class="w-full bg-[#F9FAFB] border-2 border-[#E5E7EB] rounded-2xl py-4 px-6 text-lg font-bold outline-none focus:border-[#07CBBB] transition-all">
                        <x-input-error for="cform.nombre" />
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Superficie Total</label>
                        <div class="relative max-w-[200px]">
                            <input type="number" step="0.01" wire:model.defer="cform.hectarea" class="w-full bg-[#F9FAFB] border-2 border-[#E5E7EB] rounded-2xl py-5 px-6 text-3xl font-black outline-none focus:border-[#07CBBB]">
                            <span class="absolute right-6 top-1/2 -translate-y-1/2 text-xs font-black text-slate-300">ha</span>
                        </div>
                        <x-input-error for="cform.hectarea" />
                    </div>

                    <div class="space-y-3 pt-4 border-t border-slate-100">
                        <div class="flex items-center justify-between ml-1">
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Centros de Trabajo</label>
                                <p class="text-[10px] text-slate-400 font-medium mt-0.5">Añade los centros que pertenecen a esta empresa</p>
                            </div>
                            <button wire:click="addCentro" type="button" class="bg-[#F0FDFA] text-[#07CBBB] hover:bg-[#07CBBB] hover:text-white rounded-full w-8 h-8 flex items-center justify-center transition-all shadow-sm shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                            </button>
                        </div>

                        <div class="space-y-3 mt-4">
                            @foreach($cform->centros_trabajo as $index => $centro)
                                <div class="flex items-center gap-3 group" wire:key="centro-{{ $index }}">
                                    <div class="relative flex-1">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-slate-300 group-focus-within:text-[#07CBBB] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        </div>
                                        <input type="text" wire:model.defer="cform.centros_trabajo.{{ $index }}" placeholder="Ej: Sede Norte" class="w-full bg-[#F9FAFB] border-2 border-[#E5E7EB] rounded-2xl py-3 pl-11 pr-5 text-sm font-bold text-slate-700 outline-none focus:border-[#07CBBB] transition-all">
                                    </div>
                                    @if(count($cform->centros_trabajo) > 1)
                                        <button wire:click="removeCentro({{ $index }})" type="button" class="text-slate-300 hover:text-red-500 hover:bg-red-50 p-3 rounded-2xl transition-all border-2 border-transparent hover:border-red-100 shrink-0" title="Eliminar centro">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    @else
                                        <div class="w-[52px] shrink-0"></div> <!-- Placeholder to keep inputs aligned when there's only one -->
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="p-6 sm:p-10 bg-[#F8FAFC] flex items-center justify-between border-t border-slate-100">
                    <button @click="open = false" class="text-slate-400 hover:text-red-500 font-black text-[10px] uppercase tracking-widest flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm">✕</span>
                        Cancelar
                    </button>
                    
                    <button wire:click="crearEmpresa" class="bg-[#111827] text-white font-bold px-8 py-4 rounded-2xl shadow-lg flex items-center gap-3 active:scale-95 transition-all text-sm">
                        Guardar Registro
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-width="2.5"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>