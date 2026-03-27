<div>
    <button wire:click="openCrear" class="inline-flex items-center px-8 py-4 bg-slate-800 hover:bg-black text-white text-xs font-black uppercase tracking-widest rounded-2xl transition-all shadow-lg hover:-translate-y-1">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Nuevo Albarán
    </button>

    @if($openCrear)
    @php $formPath = $isEditing ? 'updateForm' : 'createForm'; @endphp
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-md p-4 text-left">
        <div class="bg-white/90 backdrop-blur-2xl rounded-[2.5rem] shadow-[0_25px_70px_rgba(0,0,0,0.1)] border border-white w-full max-w-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
            
            <div class="px-10 py-8 border-b border-slate-100 flex justify-between items-center bg-white/50">
                <div>
                    <h3 class="text-2xl font-black text-slate-800 tracking-tighter">
                        {{ $isEditing ? 'Editar Albarán #' . $updateForm->albaranModel->id : 'Configurar Albarán' }}
                    </h3>
                    <p class="text-slate-400 text-xs font-medium italic">Actualiza la información del stock</p>
                </div>
                <button wire:click="cerrarModal" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 text-slate-400 hover:bg-rose-500 hover:text-white transition-all">&times;</button>
            </div>

            <div class="p-10 space-y-8 max-h-[70vh] overflow-y-auto custom-scrollbar">
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Empresa</label>
                        <select wire:model.live="{{ $formPath }}.empresa_id" class="w-full bg-slate-50 border-slate-200 rounded-2xl py-3.5 px-4 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-slate-800/5 transition-all">
                            <option value="">Seleccionar...</option>
                            @foreach($empresas as $e) <option value="{{$e->id}}">{{$e->nombre}}</option> @endforeach
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Centro</label>
                        <select wire:model="{{ $formPath }}.centro_trabajo_id" class="w-full bg-slate-50 border-slate-200 rounded-2xl py-3.5 px-4 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-slate-800/5 transition-all">
                            <option value="">Seleccionar...</option>
                            @foreach($centros as $c) <option value="{{$c->id}}">{{$c->nombre}}</option> @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Estado</label>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach(['pendiente', 'entregado', 'retirado'] as $est)
                        <label class="relative cursor-pointer group text-center">
                            <input type="radio" wire:model="{{ $formPath }}.estado" value="{{ $est }}" class="peer sr-only">
                            <div class="p-4 rounded-2xl border-2 border-slate-100 bg-slate-50/50 transition-all peer-checked:border-slate-800 peer-checked:bg-slate-800 peer-checked:text-white">
                                <p class="text-[10px] font-black uppercase tracking-tighter">{{ $est }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="bg-slate-50/50 rounded-[2rem] p-6 border border-slate-100">
                    <div class="flex justify-between items-center mb-4 px-2">
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Móviles Vinculados</span>
                        <button type="button" wire:click="$toggle('showMovilModal')" class="text-[10px] font-black text-blue-600 uppercase tracking-widest">+ BUSCAR</button>
                    </div>

                    @if($showMovilModal)
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="IMEI..." class="w-full mb-4 p-3 border-2 border-blue-100 rounded-xl text-sm font-bold outline-none focus:border-blue-400">
                        @if(count($search_results) > 0)
                            <div class="bg-white border rounded-xl shadow-xl max-h-32 overflow-auto mb-4">
                                @foreach($search_results as $res)
                                    <div wire:click="addMovil({{$res->id}})" class="p-3 hover:bg-blue-50 cursor-pointer text-xs font-bold border-b">{{$res->codigo}}</div>
                                @endforeach
                            </div>
                        @endif
                    @endif

                    <div class="grid grid-cols-1 gap-2">
                        @foreach($movilesSeleccionados as $m)
                            <div class="flex justify-between items-center bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
                                <span class="text-xs font-black italic">{{$m->codigo}}</span>
                                <button wire:click="quitarMovil({{$m->id}})" class="text-rose-500 font-bold">&times;</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="px-10 py-6 bg-slate-50/80 flex justify-end gap-3 border-t">
                <button wire:click="cerrarModal" class="px-6 py-3 text-[10px] font-black uppercase text-slate-400">Cancelar</button>
                <button wire:click="save" class="px-10 py-4 bg-slate-800 hover:bg-black text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-slate-200 transition-all hover:-translate-y-1">
                    {{ $isEditing ? 'Guardar Cambios' : 'Generar Albarán' }}
                </button>
            </div>
        </div>
    </div>
    @endif
</div>