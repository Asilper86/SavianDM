<div>
    <button wire:click="$set('openCrear', true)"
        class="bg-[#07CBBB] hover:bg-cyan-500 text-white font-bold px-10 py-4 rounded-[1.5rem] transition-all shadow-xl shadow-cyan-200/50 hover:-translate-y-1 flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Añadir Registro
    </button>

    <x-dialog-modal wire:model="openCrear" maxWidth="2xl">
        <x-slot name="title">
            <div class="relative flex items-center gap-6 px-6 py-4 bg-gradient-to-r from-slate-50 to-white rounded-t-[3rem]">
                <div class="relative">
                    <div class="absolute inset-0 bg-cyan-200 blur-xl opacity-40 rounded-full"></div>
                    <div class="relative w-16 h-16 rounded-[1.8rem] bg-white shadow-xl shadow-cyan-100/50 text-[#07CBBB] flex items-center justify-center border border-cyan-50">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex flex-col">
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight leading-none mb-1">Nueva Finca</h3>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#07CBBB] animate-pulse"></span>
                        <p class="text-[10px] text-slate-400 font-extrabold uppercase tracking-[0.3em]">Configuración de Activos</p>
                    </div>
                </div>
            </div>
        </x-slot>
    
        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 px-6 py-8">
                
                <div class="md:col-span-2 space-y-3">
                    <label class="flex items-center gap-2 ml-4 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                        <svg class="w-4 h-4 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 7h10M7 12h10M7 17h10" stroke-width="2" stroke-linecap="round"/></svg>
                        Nombre de la empresa
                    </label>
                    <div class="relative group">
                        <input type="text" wire:model="form.nombre" placeholder="Nombre descriptivo de la finca"
                            class="w-full bg-slate-50/50 border-2 border-slate-100 rounded-[2rem] py-5 px-8 text-slate-700 font-bold text-lg shadow-sm focus:bg-white focus:border-[#07CBBB] focus:ring-4 focus:ring-cyan-50 transition-all duration-300 outline-none placeholder:text-slate-300">
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 opacity-0 group-focus-within:opacity-100 transition-opacity">
                            <span class="text-[10px] font-black text-cyan-600 bg-cyan-50 px-3 py-1 rounded-full uppercase">Editando</span>
                        </div>
                    </div>
                    <x-input-error for="form.nombre" class="mt-2 ml-6 text-xs font-bold text-red-500" />
                </div>
    
                <div class="space-y-3">
                    <label class="flex items-center gap-2 ml-4 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                        <svg class="w-4 h-4 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h7" stroke-width="2" stroke-linecap="round"/></svg>
                        Superficie
                    </label>
                    <div class="relative group">
                        <input type="number" step="0.01" wire:model="form.hectarea" placeholder="0.00"
                            class="w-full bg-slate-50/50 border-2 border-slate-100 rounded-[2rem] py-5 px-8 text-slate-800 font-black text-2xl shadow-sm focus:bg-white focus:border-[#07CBBB] focus:ring-4 focus:ring-cyan-50 transition-all duration-300 outline-none">
                        <span class="absolute right-8 top-1/2 -translate-y-1/2 text-sm font-black text-slate-300 group-focus-within:text-[#07CBBB]">ha</span>
                    </div>
                    <x-input-error for="form.hectarea" class="mt-2 ml-6 text-xs font-bold text-red-500" />
                </div>
    
                <div class="space-y-3">
                    <label class="flex items-center gap-2 ml-4 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                        Centro de Trabajo
                    </label>
                    <div class="h-[72px] bg-slate-100/50 rounded-[2rem] border-2 border-dashed border-slate-200 flex items-center justify-center text-slate-400 text-xs font-bold italic">
                        Selección automática según perfil
                    </div>
                </div>
    
            </div>
        </x-slot>
    
        <x-slot name="footer">
            <div class="flex items-center justify-between w-full px-6 pb-8">
                <button wire:click="$set('openCrear', false)" 
                    class="group flex items-center gap-2 text-slate-400 hover:text-slate-600 font-black text-xs uppercase tracking-widest transition-all">
                    <span class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center group-hover:bg-slate-100 transition-colors">✕</span>
                    Cancelar
                </button>
                
                <button wire:click="save"
                    class="relative overflow-hidden group bg-[#07CBBB] hover:bg-[#06b5a6] text-white font-black px-14 py-5 rounded-[2.2rem] transition-all shadow-[0_15px_30px_rgba(7,203,187,0.3)] hover:shadow-[0_20px_40px_rgba(7,203,187,0.4)] hover:-translate-y-1 active:scale-95">
                    <span class="relative z-10 flex items-center gap-3">
                        Crear Registro
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </span>
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-shimmer"></div>
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
    
    <style>
    @keyframes shimmer {
        100% { transform: translateX(100%); }
    }
    .animate-shimmer {
        animation: shimmer 1.5s infinite;
    }
    </style>
</div>