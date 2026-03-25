<div>
    <button wire:click="$set('openCrear', true)"
        class="w-full lg:w-auto bg-slate-900 text-white px-6 py-3 rounded-2xl font-bold text-sm shadow-lg hover:bg-slate-800 transition-all flex items-center justify-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M12 4v16m8-8H4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        Nuevo Proveedor
    </button>
    <x-dialog-modal wire:model="openCrear">
        <x-slot name="title">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center shadow-sm">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl sm:text-3xl font-black text-slate-800 tracking-tight">Nuevo Proveedor</h3>
                    <p class="text-[9px] sm:text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Gestión de Suministros</p>
                </div>
            </div>
        </x-slot>
    
        <x-slot name="content">
            <div class="space-y-6 mt-4">
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nombre Comercial</label>
                    <input type="text" 
                           wire:model="cform.nombre" 
                           placeholder="Ej: Distribuidora Central S.A." 
                           class="w-full bg-[#F9FAFB] border-2 border-[#E5E7EB] rounded-2xl py-4 px-6 text-lg font-bold outline-none focus:border-indigo-500 transition-all placeholder:text-slate-300">
                    <x-input-error for="cform.nombre" />
                </div>
    
                <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                    <p class="text-[11px] text-slate-500 leading-relaxed">
                        <span class="font-bold text-indigo-500">Nota:</span> Asegúrese de que el nombre coincida con el registro fiscal para evitar duplicados en la facturación.
                    </p>
                </div>
            </div>
        </x-slot>
    
        <x-slot name="footer">
            <div class="flex items-center justify-between w-full">
                <button wire:click="$set('open', false)" 
                        class="text-slate-400 hover:text-red-500 font-black text-[10px] uppercase tracking-widest flex items-center gap-2 transition-all group">
                    <span class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm border border-slate-100 group-hover:border-red-100">✕</span>
                    Cancelar
                </button>
                
                <button wire:click="crearProveedor" 
                        wire:loading.attr="disabled"
                        class="bg-slate-900 text-white font-bold px-8 py-4 rounded-2xl shadow-lg flex items-center gap-3 active:scale-95 transition-all text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                    
                    <span wire:loading.remove wire:target="crearProveedor">Registrar Proveedor</span>
                    <span wire:loading wire:target="crearProveedor">Procesando...</span>
                    
                    <svg wire:loading.remove wire:target="crearProveedor" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
