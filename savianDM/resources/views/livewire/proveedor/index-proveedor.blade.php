<div class="w-full min-h-screen bg-[#F3F4F6] p-2 sm:p-4 md:p-8 flex flex-col font-sans">
    <div
        class="bg-white/80 backdrop-blur-xl rounded-[2rem] sm:rounded-[3.5rem] shadow-[0_20px_60px_rgba(0,0,0,0.03)] border border-white p-4 sm:p-10 flex-1 flex flex-col overflow-hidden">

        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-4 px-2">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <span class="hidden sm:block w-8 h-1 bg-indigo-500 rounded-full"></span>
                    <h3 class="text-2xl sm:text-4xl font-black text-slate-800 tracking-tighter">Panel de Proveedores</h3>
                </div>
                <p class="text-slate-400 text-xs sm:text-sm font-medium sm:ml-11">Directorio logístico y de suministros.
                </p>
            </div>

            <div class="w-full lg:w-auto">
                @livewire('proveedor.create-proveedor')
            </div>
        </div>

        <div class="flex-1 overflow-auto rounded-3xl custom-scrollbar">
            <table class="w-full border-separate border-spacing-y-3">
                <thead class="sticky top-0 bg-white/10 backdrop-blur-md z-10">
                    <tr class="text-slate-400">
                        <th class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-left w-20">ID</th>
                        <th class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-left">Nombre</th>
                        <th class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedor as $item)
                        <tr class="group">
                            <td
                                class="bg-slate-50/50 px-6 py-5 rounded-l-3xl border-y border-l border-transparent text-xs font-bold text-slate-400">
                                #{{ $item->id }} </td>
                            <td class="bg-slate-50/50 px-6 py-5 border-y border-transparent font-black text-slate-700">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shadow-sm border border-slate-100 text-indigo-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                                stroke-width="1.5" />
                                        </svg>
                                    </div>
                                    <span class="text-sm sm:text-base">{{ $item->nombre }}</span>
                                </div>
                            </td>
                            <td
                                class="bg-slate-50/50 px-6 py-5 rounded-r-3xl border-y border-r border-transparent text-right">
                                <div class="flex justify-end gap-2">
                                    <button wire:click="update({{ $item->id }})"
                                        class="p-2 bg-white text-slate-400 hover:text-indigo-500 rounded-lg transition-colors border border-slate-100 shadow-sm"><svg
                                            class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                                stroke-width="2" />
                                        </svg></button>
                                    <button wire:click="borrar({{ $item->id }})" onclick="confirm('¿Desea eliminar definitivamente?')"
                                        class="p-2 bg-white text-slate-400 hover:text-red-500 rounded-lg transition-colors border border-slate-100 shadow-sm"><svg
                                            class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                stroke-width="2" />
                                        </svg></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>

            <div>
                {{ $proveedor->links() }}
            </div>
        </div>

    </div>


    <x-dialog-modal wire:model="openEditar">
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
                           wire:model="uform.nombre" 
                           placeholder="Ej: Distribuidora Central S.A." 
                           class="w-full bg-[#F9FAFB] border-2 border-[#E5E7EB] rounded-2xl py-4 px-6 text-lg font-bold outline-none focus:border-indigo-500 transition-all placeholder:text-slate-300">
                    <x-input-error for="uform.nombre" />
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
                <button wire:click="cancelar" 
                        class="text-slate-400 hover:text-red-500 font-black text-[10px] uppercase tracking-widest flex items-center gap-2 transition-all group">
                    <span class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm border border-slate-100 group-hover:border-red-100">✕</span>
                    Cancelar
                </button>
                
                <button wire:click="editar" 
                        wire:loading.attr="disabled"
                        class="bg-slate-900 text-white font-bold px-8 py-4 rounded-2xl shadow-lg flex items-center gap-3 active:scale-95 transition-all text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                    
                    <span wire:loading.remove wire:target="editar">Registrar Proveedor</span>
                    <span wire:loading wire:target="editar">Procesando...</span>
                    
                    <svg wire:loading.remove wire:target="editar" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
