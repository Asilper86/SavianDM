<div class="p-4">
    <button wire:click="$set('openCrear', true)" 
        class="group relative inline-flex items-center gap-2 px-6 py-3 font-bold text-white transition-all duration-300 bg-gradient-to-r from-emerald-600 to-teal-500 rounded-xl hover:from-emerald-500 hover:to-teal-400 shadow-[0_10px_20px_-10px_rgba(16,185,129,0.5)] active:scale-95">
        <i class="fa-solid fa-plus text-sm group-hover:rotate-90 transition-transform"></i>
        <span>{{ __('Nuevo Registro') }}</span>
    </button>

    <x-dialog-modal wire:model="openCrear" maxWidth="2xl">
        <x-slot name="title">
            <div class="relative flex items-center p-1">
                <div class="relative">
                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-cyan-400 rounded-xl blur opacity-25"></div>
                    <div class="relative p-3 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-white/5">
                        <i class="fa-solid fa-mobile-screen-button text-xl text-blue-500"></i>
                    </div>
                </div>
                <div class="ms-4">
                    <h3 class="text-xl font-black tracking-tight text-slate-800 dark:text-white uppercase">
                        {{ __('Registrar Terminal') }}
                    </h3>
                    <p class="text-xs font-medium text-slate-400 dark:text-slate-500 tracking-wider">
                        Añade un nuevo dispositivo al inventario general
                    </p>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 py-4">
                
                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold uppercase tracking-widest text-blue-600 dark:text-blue-400 ml-1">Fabricante</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fa-solid fa-industry text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                        </div>
                        <input type="text" wire:model="marca" placeholder="Ej: Apple"
                            class="block w-full pl-10 pr-4 py-3 bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 text-sm rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all shadow-sm">
                    </div>
                    @error('marca') <span class="text-[10px] text-red-500 font-bold uppercase ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400 ml-1">Modelo Específico</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fa-solid fa-microchip text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                        </div>
                        <input type="text" wire:model="modelo" placeholder="Ej: iPhone 15 Pro"
                            class="block w-full pl-10 pr-4 py-3 bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 text-sm rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all shadow-sm">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400 ml-1">Identificador (IMEI)</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fa-solid fa-barcode text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                        </div>
                        <input type="text" wire:model="imei" placeholder="0000-0000-0000"
                            class="block w-full pl-10 pr-4 py-3 bg-slate-50/50 dark:bg-slate-900 border-dashed border-2 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 text-sm rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all tracking-widest font-mono">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400 ml-1">Asignación</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fa-solid fa-building-user text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                        </div>
                        <select wire:model="empresa_id"
                            class="block w-full pl-10 pr-10 py-3 bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 text-sm rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all appearance-none cursor-pointer">
                            <option value="">Seleccionar destino...</option>
                            @foreach ( $empresa as $item )
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                            <i class="fa-solid fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 space-y-1.5">
                    <label class="text-[11px] font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400 ml-1">Observaciones técnicas</label>
                    <textarea wire:model="notas" rows="3" placeholder="Describe el estado del equipo o accesorios incluidos..."
                        class="block w-full p-4 bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 text-sm rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all resize-none shadow-sm"></textarea>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex items-center justify-between w-full mt-2">
                <button wire:click="$set('openCrear', false)" 
                    class="group flex items-center text-sm font-bold text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors">
                    <i class="fa-solid fa-xmark me-2 group-hover:rotate-90 transition-transform"></i>
                    {{ __('Descartar') }}
                </button>

                <div class="flex gap-3">
                    <button wire:click="save" wire:loading.attr="disabled" 
                        class="relative inline-flex items-center px-8 py-3 bg-slate-900 dark:bg-blue-600 hover:bg-slate-800 dark:hover:bg-blue-500 text-white text-sm font-bold rounded-xl transition-all shadow-xl shadow-blue-500/20 active:scale-95 disabled:opacity-50 overflow-hidden">
                        <div wire:loading wire:target="save" class="absolute inset-0 bg-blue-600 flex items-center justify-center">
                            <i class="fa-solid fa-circle-notch animate-spin"></i>
                        </div>
                        <i wire:loading.remove wire:target="save" class="fa-solid fa-cloud-arrow-up me-2"></i>
                        <span>{{ __('Finalizar Registro') }}</span>
                    </button>
                </div>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>