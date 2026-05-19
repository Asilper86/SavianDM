<div>
    <button wire:click="$set('openCrear', true)" 
        class="group relative inline-flex items-center justify-center bg-[#07CBBB] hover:bg-[#06B8A9] text-white font-black px-6 sm:px-8 py-3.5 sm:py-4 rounded-2xl shadow-xl hover:shadow-[#07CBBB]/30 transition-all active:scale-95 overflow-hidden">
        <span class="relative z-10 flex items-center gap-2 sm:gap-3 text-sm sm:text-base">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            Nuevo Material
        </span>
        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
    </button>

    <x-dialog-modal wire:model="openCrear" maxWidth="2xl">
        <x-slot name="title">
            <div class="flex items-center gap-4 p-4">
                <div class="w-12 h-12 rounded-2xl bg-[#E4F4F3] text-[#07CBBB] flex items-center justify-center shadow-sm">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-800 tracking-tight">Alta de Material</h3>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="px-4 pb-6 space-y-6">
                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Nombre del Material</label>
                    <input wire:model="cform.nombre" type="text"
                        class="w-full bg-slate-50 border border-slate-200 rounded-[1.2rem] py-3 px-5 text-sm font-bold focus:ring-4 focus:ring-[#07B8AA]/10 focus:border-[#07B8AA] outline-none transition-all text-slate-700">
                    <x-input-error for="cform.nombre" class="mt-1 ml-1" />
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Stock (Cantidad Inicial)</label>
                    <input wire:model="cform.cantidad" type="number"
                        class="w-full bg-slate-50 border border-slate-200 rounded-[1.2rem] py-3 px-5 text-sm font-bold focus:ring-4 focus:ring-[#07B8AA]/10 focus:border-[#07B8AA] outline-none transition-all text-slate-700">
                    <x-input-error for="cform.cantidad" class="mt-1 ml-1" />
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Descripción (Opcional)</label>
                    <textarea wire:model="cform.descripcion" rows="3"
                        class="w-full bg-slate-50 border border-slate-200 rounded-[1.2rem] py-3 px-5 text-sm font-bold focus:ring-4 focus:ring-[#07B8AA]/10 focus:border-[#07B8AA] outline-none transition-all text-slate-700"></textarea>
                    <x-input-error for="cform.descripcion" class="mt-1 ml-1" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex items-center justify-between w-full px-4 pb-4">
                <button wire:click="cancelar" type="button"
                    class="text-[11px] font-black text-slate-400 hover:text-red-500 uppercase tracking-[0.2em] transition-all">
                    Cancelar
                </button>

                <button wire:click="crearMaterial" wire:loading.attr="disabled"
                    class="bg-[#111827] hover:bg-[#07B8AA] text-white font-bold px-10 py-4 rounded-[1.2rem] shadow-xl hover:shadow-[#07B8AA]/20 flex items-center gap-3 transition-all active:scale-95 group">
                    <span wire:loading.remove wire:target="crearMaterial">Crear Material</span>
                    <span wire:loading wire:target="crearMaterial" class="text-xs">Guardando...</span>
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
