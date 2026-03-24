<div x-data="{ open: @entangle('openCrear') }">
    <button @click="open = true" class="bg-[#E4F4F3] hover:bg-[#07B8AA] text-[#07B8AA] hover:text-white font-bold px-8 py-4 rounded-full transition-all flex items-center gap-3 text-sm shadow-sm active:scale-95">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
        Nuevo Registro
    </button>

    <div x-show="open" class="fixed inset-0 z-[100]" style="display: none;">
        <div x-show="open" x-transition:opacity.duration.500ms @click="open = false" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>

        <div class="fixed inset-y-0 right-0 max-w-xl w-full flex">
            <div x-show="open" 
                 x-transition:enter="transform transition ease-out duration-500" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                 class="w-full bg-white shadow-2xl flex flex-col h-full rounded-l-[4rem]">
                
                <div class="pt-16 px-12 pb-8">
                    <div class="flex items-center gap-5">
                        <div class="w-20 h-20 rounded-[2.2rem] bg-slate-50 text-[#07CBBB] flex items-center justify-center border border-cyan-50 shadow-inner">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-4xl font-black text-slate-800 tracking-tighter">Nuevo Móvil</h3>
                            <p class="text-[11px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-2">ALTA DE DISPOSITIVO</p>
                        </div>
                    </div>
                </div>

                <div class="flex-1 px-12 py-10 overflow-y-auto space-y-8">
                    <div class="space-y-3">
                        <label class="text-[12px] font-black text-slate-400 uppercase tracking-widest ml-1">Número de Serie (SN)</label>
                        <input type="text" placeholder="MOV-XXXX" class="w-full bg-[#F9FAFB] border-2 border-[#E5E7EB] rounded-[2rem] py-5 px-8 text-slate-800 font-bold text-lg focus:border-[#07CBBB] outline-none transition-all">
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <label class="text-[12px] font-black text-slate-400 uppercase tracking-widest ml-1">Modelo</label>
                            <input type="text" placeholder="iPhone 15 Pro" class="w-full bg-[#F9FAFB] border-2 border-[#E5E7EB] rounded-[2rem] py-5 px-8 text-slate-800 font-bold outline-none">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[12px] font-black text-slate-400 uppercase tracking-widest ml-1">Estado</label>
                            <select class="w-full bg-[#F9FAFB] border-2 border-[#E5E7EB] rounded-[2rem] py-5 px-8 text-slate-800 font-bold outline-none">
                                <option>Stock</option>
                                <option>Campo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="bg-[#F8FAFC] px-12 py-12 flex items-center justify-between border-t border-slate-100 rounded-bl-[4rem]">
                    <button @click="open = false" class="flex items-center gap-3 text-slate-400 hover:text-red-500 font-black text-xs uppercase tracking-widest transition-all">
                        <span class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-sm">✕</span>
                        CANCELAR
                    </button>
                    <button class="bg-[#111827] hover:bg-black text-white font-bold px-12 py-6 rounded-[2.5rem] shadow-2xl flex items-center gap-4 transition-all active:scale-95">
                        Guardar Registro
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>