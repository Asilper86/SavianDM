<div>
    <button wire:click="abrirModalCrear" class="inline-flex items-center px-8 py-4 bg-slate-800 hover:bg-black text-white text-xs font-black uppercase tracking-widest rounded-2xl transition-all shadow-lg hover:-translate-y-1">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Nuevo Albarán
    </button>

    <x-dialog-modal wire:model="openCrear" maxWidth="2xl">
        <x-slot name="title">
            @php $formPath = $isEditing ? 'updateForm' : 'createForm'; @endphp
            <div class="flex justify-between items-center w-full">
                <div>
                    <h3 class="text-2xl font-black text-slate-800 tracking-tighter">
                        {{ $isEditing ? 'Editar Albarán #' . $updateForm->albaranModel?->id : 'Configurar Albarán' }}
                    </h3>
                    <p class="text-slate-400 text-xs font-medium italic mt-1">Actualiza la información del stock</p>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-8 py-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Empresa</label>
                        <select wire:model.live="{{ $formPath }}.empresa_id" class="w-full bg-slate-50 border-slate-200 rounded-2xl py-3.5 px-4 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-slate-800/5 transition-all">
                            <option value="">Seleccionar...</option>
                            @foreach($empresas as $e) <option value="{{$e->id}}">{{$e->nombre}}</option> @endforeach
                        </select>
                        <x-input-error for="{{ $formPath }}.empresa_id" />
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Centro</label>
                        <select wire:model="{{ $formPath }}.centro_trabajo_id" class="w-full bg-slate-50 border-slate-200 rounded-2xl py-3.5 px-4 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-slate-800/5 transition-all">
                            <option value="">Seleccionar...</option>
                            @foreach($centros as $c) <option value="{{$c->id}}">{{$c->nombre}}</option> @endforeach
                        </select>
                        <x-input-error for="{{ $formPath }}.centro_trabajo_id" />
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
                        <button type="button" wire:click="$toggle('showMovilModal')" class="text-[10px] font-black text-blue-600 uppercase tracking-widest hover:underline">+ BUSCAR</button>
                    </div>

                    @if($showMovilModal)
                        <div class="relative animate-in slide-in-from-top-2">
                            <input type="text" wire:model.live.debounce.300ms="search" placeholder="IMEI..." class="w-full mb-2 p-3 border-2 border-blue-100 rounded-xl text-sm font-bold outline-none focus:border-blue-400">
                            @if(count($search_results) > 0)
                                <div class="absolute z-50 w-full bg-white border rounded-xl shadow-xl max-h-40 overflow-auto mb-4">
                                    @foreach($search_results as $res)
                                        <div wire:click="addMovil({{$res->id}})" class="p-3 hover:bg-blue-50 cursor-pointer text-xs font-bold border-b">{{$res->codigo}}</div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="grid grid-cols-1 gap-2 mt-4">
                        @foreach($movilesSeleccionados as $m)
                            <div class="flex justify-between items-center bg-white p-4 rounded-2xl border border-slate-100 shadow-sm transition-all hover:shadow-md">
                                <span class="text-xs font-black italic text-slate-700 italic tracking-tighter">{{$m->codigo}}</span>
                                <button wire:click="quitarMovil({{$m->id}})" class="text-rose-400 hover:text-rose-600 font-bold p-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        @endforeach
                        <x-input-error for="{{ $formPath }}.moviles_ids" />
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex gap-3">
                <button wire:click="cerrarModal" class="px-6 py-3 text-[10px] font-black uppercase text-slate-400 hover:text-slate-600 transition-colors">
                    Cancelar
                </button>
                <button wire:click="save" wire:loading.attr="disabled" class="px-10 py-4 bg-slate-800 hover:bg-black text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-slate-200 transition-all hover:-translate-y-1">
                    <span wire:loading.remove>{{ $isEditing ? 'Guardar Cambios' : 'Generar Albarán' }}</span>
                    <span wire:loading>Procesando...</span>
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>