<div class="w-full min-h-screen bg-[#F3F4F6] p-2 sm:p-4 md:p-8 flex flex-col font-sans">
    <div class="bg-white/80 backdrop-blur-xl rounded-[2rem] sm:rounded-[3.5rem] shadow-[0_20px_60px_rgba(0,0,0,0.03)] border border-white p-4 sm:p-10 flex-1 flex flex-col overflow-hidden">

        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-4 px-2">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <span class="hidden sm:block w-8 h-1 bg-slate-800 rounded-full"></span>
                    <h3 class="text-2xl sm:text-4xl font-black text-slate-800 tracking-tighter">Registro de Albaranes</h3>
                </div>
                <p class="text-slate-400 text-xs sm:text-sm font-medium sm:ml-11">Control de entradas y salidas de mercancía.</p>
            </div>

            <div class="relative w-full lg:w-96 group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400 group-focus-within:text-slate-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" wire:model.live="search" placeholder="Buscar por número o fecha..."
                    class="block w-full pl-11 pr-4 py-4 bg-slate-50/50 border-2 border-transparent rounded-2xl text-sm font-bold text-slate-700 outline-none focus:bg-white focus:border-slate-800 focus:ring-4 focus:ring-slate-800/5 transition-all shadow-sm">
            </div>

            <div class="w-full lg:w-auto">
                @livewire('albaran.create-albaran')
            </div>
        </div>

        <div class="flex-1 overflow-auto rounded-3xl custom-scrollbar">
            <table class="w-full border-separate border-spacing-y-3">
                <thead class="sticky top-0 bg-white/10 backdrop-blur-md z-10">
                    <tr class="text-slate-400">
                        <th class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-left w-24">Nº Albarán</th>
                        <th class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-left">Fecha de Emisión</th>
                        <th class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($albaran as $item)
                        <tr class="group">
                            <td class="bg-slate-50/50 px-6 py-5 rounded-l-3xl border-y border-l border-transparent text-xs font-black text-slate-500 italic">
                                #{{ $item->id }}
                            </td>
                            

                            <td class="bg-slate-50/50 px-6 py-5 border-y border-transparent font-bold text-slate-700">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shadow-sm border border-slate-100 text-slate-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <span class="text-sm">{{ $item->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </td>

                            <td class="bg-slate-50/50 px-6 py-5 rounded-r-3xl border-y border-r border-transparent text-right">
                                <div class="flex justify-end gap-2">
                                    <button wire:click="descargarPDF({{ $item->id }})" title="Descargar PDF"
                                        class="p-3 bg-white text-blue-600 hover:bg-blue-600 hover:text-white rounded-xl transition-all border border-slate-100 shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </button>

                                    <button title="Editar" class="p-3 bg-white text-amber-500 hover:bg-amber-500 hover:text-white rounded-xl transition-all border border-slate-100 shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>

                                    <button title="Eliminar" class="p-3 bg-white text-red-500 hover:bg-red-500 hover:text-white rounded-xl transition-all border border-slate-100 shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-20 text-slate-400 font-medium italic">
                                No se han encontrado albaranes registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $albaran->links() }}
        </div>
    </div>
</div>