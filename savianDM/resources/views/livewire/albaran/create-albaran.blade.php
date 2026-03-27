<div>
    <button wire:click="$set('openCrear', true)" class="inline-flex items-center px-8 py-4 bg-slate-800 hover:bg-black text-white text-xs font-black uppercase tracking-widest rounded-2xl transition-all shadow-lg shadow-slate-200 hover:-translate-y-1">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Nuevo Albarán
    </button>

    @if($openCrear)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-md p-4">
        <div class="bg-white/90 backdrop-blur-2xl rounded-[2.5rem] shadow-[0_25px_70px_rgba(0,0,0,0.1)] border border-white w-full max-w-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
            
            <div class="px-10 py-8 border-b border-slate-100 flex justify-between items-center bg-white/50">
                <div>
                    <h3 class="text-2xl font-black text-slate-800 tracking-tighter">Configurar Albarán</h3>
                    <p class="text-slate-400 text-xs font-medium italic">Gestión de stock en tiempo real</p>
                </div>
                <button wire:click="$set('openCrear', false)" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 text-slate-400 hover:bg-rose-500 hover:text-white transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-10 space-y-8 max-h-[70vh] overflow-y-auto custom-scrollbar">
                
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Empresa Cliente</label>
                        <select wire:model.live="form.empresa_id" class="w-full bg-slate-50 border-slate-200 rounded-2xl py-3.5 px-4 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-slate-800/5 transition-all">
                            <option value="">Seleccionar empresa...</option>
                            @foreach($empresas as $e) <option value="{{$e->id}}">{{$e->nombre}}</option> @endforeach
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Centro Destino</label>
                        <select wire:model="form.centro_trabajo_id" class="w-full bg-slate-50 border-slate-200 rounded-2xl py-3.5 px-4 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-slate-800/5 transition-all">
                            <option value="">Seleccionar centro...</option>
                            @foreach($centros as $c) <option value="{{$c->id}}">{{$c->nombre}}</option> @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Estado del Albarán</label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="relative cursor-pointer group">
                            <input type="radio" wire:model="form.estado" value="pendiente" class="peer sr-only">
                            <div class="p-4 rounded-2xl border-2 border-slate-100 bg-slate-50/50 text-center transition-all peer-checked:border-amber-500 peer-checked:bg-amber-50 peer-checked:shadow-sm">
                                <p class="text-[10px] font-black uppercase text-slate-500 peer-checked:text-amber-700 tracking-tighter">Pendiente</p>
                            </div>
                        </label>
                        <label class="relative cursor-pointer group">
                            <input type="radio" wire:model="form.estado" value="entregado" class="peer sr-only">
                            <div class="p-4 rounded-2xl border-2 border-slate-100 bg-slate-50/50 text-center transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:shadow-sm">
                                <p class="text-[10px] font-black uppercase text-slate-500 peer-checked:text-emerald-700 tracking-tighter">Entregado</p>
                            </div>
                        </label>
                        <label class="relative cursor-pointer group">
                            <input type="radio" wire:model="form.estado" value="retirado" class="peer sr-only">
                            <div class="p-4 rounded-2xl border-2 border-slate-100 bg-slate-50/50 text-center transition-all peer-checked:border-rose-500 peer-checked:bg-rose-50 peer-checked:shadow-sm">
                                <p class="text-[10px] font-black uppercase text-slate-500 peer-checked:text-rose-700 tracking-tighter">Retirado</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="bg-slate-50/50 rounded-[2rem] p-6 border border-slate-100">
                    <div class="flex justify-between items-center mb-4 px-2">
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Terminales Seleccionados</span>
                        <button type="button" wire:click="$toggle('showMovilModal')" class="text-[10px] font-black text-blue-600 uppercase tracking-widest hover:underline">
                            + BUSCAR POR IMEI
                        </button>
                    </div>

                    @if($showMovilModal)
                        <div class="relative mb-4 animate-in slide-in-from-top-2">
                            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Escribe el código..." class="w-full pl-4 pr-4 py-3 bg-white border-2 border-blue-100 rounded-xl text-sm font-bold shadow-sm outline-none focus:border-blue-400">
                            @if(count($search_results) > 0)
                                <div class="absolute z-20 w-full mt-1 bg-white border border-slate-100 rounded-xl shadow-xl max-h-40 overflow-y-auto">
                                    @foreach($search_results as $res)
                                        <div wire:click="addMovil({{$res->id}})" class="p-3 hover:bg-blue-50 cursor-pointer text-xs font-bold border-b border-slate-50 flex justify-between">
                                            <span>{{$res->codigo}}</span>
                                            <span class="text-blue-400 uppercase italic">{{$res->modelo->nombre ?? ''}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="grid grid-cols-1 gap-2">
                        @foreach($movilesSeleccionados as $m)
                            <div class="flex justify-between items-center bg-white p-4 rounded-2xl border border-slate-100 shadow-sm transition-all hover:shadow-md">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-slate-800 text-white flex items-center justify-center font-black text-[10px]">M</div>
                                    <span class="text-xs font-black text-slate-700 italic">{{$m->codigo}}</span>
                                </div>
                                <button wire:click="quitarMovil({{$m->id}})" class="w-6 h-6 flex items-center justify-center text-slate-300 hover:text-rose-500">&times;</button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <label class="flex items-center gap-3 cursor-pointer group px-2">
                    <input type="checkbox" wire:model="form.fundas" class="w-5 h-5 rounded-lg border-slate-300 text-slate-800 focus:ring-slate-800 transition-all">
                    <span class="text-xs font-black uppercase tracking-tighter text-slate-500 group-hover:text-slate-800 transition-colors italic">Incluir fundas</span>
                </label>

            </div>

            <div class="px-10 py-6 bg-slate-50/80 flex justify-end gap-3 border-t border-slate-100">
                <button wire:click="$set('openCrear', false)" class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-colors">Cancelar</button>
                <button wire:click="saveAlbaran" wire:loading.attr="disabled" class="px-10 py-4 bg-slate-800 hover:bg-black text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-slate-200 transition-all hover:-translate-y-1 flex items-center gap-2">
                    <span wire:loading.remove>Generar Albarán</span>
                    <span wire:loading>Procesando...</span>
                </button>
            </div>

        </div>
    </div>
    @endif
</div>