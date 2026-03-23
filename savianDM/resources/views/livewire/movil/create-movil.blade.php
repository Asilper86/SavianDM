<div class="p-4">
    <button wire:click="$set('openCrear', true)" 
        class="bg-green-600 hover:bg-green-500 dark:bg-green-500 dark:hover:bg-green-400 text-white font-bold py-2.5 px-5 rounded-xl transition-all flex items-center gap-2 shadow-lg shadow-green-500/20 active:scale-95">
        <i class="fa-solid fa-plus text-sm"></i>
        <span>{{ __('Nuevo Registro') }}</span>
    </button>

    <x-dialog-modal wire:model="openCrear">
        <x-slot name="title">
            <div class="flex items-center text-slate-800 dark:text-slate-100 border-b border-slate-100 dark:border-white/10 pb-4">
                <div class="p-2.5 bg-blue-500/10 dark:bg-blue-400/20 rounded-xl me-3">
                    <i class="fa-solid fa-mobile-screen text-blue-600 dark:text-blue-400"></i>
                </div>
                <span class="font-extrabold tracking-tight">{{ __('Registrar Nuevo Teléfono') }}</span>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 ms-1">Marca</label>
                    <div class="relative group">
                        <i class="fa-solid fa-tag absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors text-xs"></i>
                        <input type="text" wire:model="marca" placeholder="Ej: Samsung"
                            class="w-full ps-10 bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all placeholder:text-slate-400 dark:placeholder:text-slate-600">
                    </div>
                    @error('marca') <span class="text-xs text-red-500 font-medium ms-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 ms-1">Modelo</label>
                    <div class="relative group">
                        <i class="fa-solid fa-circle-info absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors text-xs"></i>
                        <input type="text" wire:model="modelo" placeholder="Ej: Galaxy S23"
                            class="w-full ps-10 bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 ms-1">IMEI / S/N</label>
                    <div class="relative group">
                        <i class="fa-solid fa-barcode absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors text-xs"></i>
                        <input type="text" wire:model="imei" placeholder="15 dígitos..."
                            class="w-full ps-10 bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 ms-1">Empresa Asignada</label>
                    <div class="relative group">
                        <i class="fa-solid fa-building absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors text-xs"></i>
                        <select wire:model="empresa_id"
                            class="w-full ps-10 bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all appearance-none">
                            <option value="">Selecciona una empresa</option>
                            @foreach ( $empresa as $item )
                                <option value="{{ $item->id }}" class="text-slate-900">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="md:col-span-2 space-y-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 ms-1">Notas / Estado</label>
                    <textarea wire:model="notas" rows="3" placeholder="Añade detalles relevantes..."
                        class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all resize-none"></textarea>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex items-center justify-end space-x-3 w-full border-t border-slate-100 dark:border-white/10 pt-4">
                <button wire:click="$set('showingModal', false)" 
                    class="px-5 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-white transition-colors">
                    {{ __('Cancelar') }}
                </button>

                <button wire:click="save" wire:loading.attr="disabled" 
                    class="inline-flex items-center px-6 py-2.5 bg-blue-600 hover:bg-blue-500 dark:bg-blue-500 dark:hover:bg-blue-400 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-blue-500/25 active:scale-95 disabled:opacity-50">
                    <i wire:loading.remove wire:target="save" class="fa-solid fa-floppy-disk me-2"></i>
                    <i wire:loading wire:target="save" class="fa-solid fa-circle-notch animate-spin me-2"></i>
                    {{ __('Guardar') }}
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>