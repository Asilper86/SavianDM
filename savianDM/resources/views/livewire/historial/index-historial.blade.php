<div class="w-full min-h-screen bg-[#F3F4F6] p-4 md:p-8 flex flex-col font-sans">
    <div class="bg-white/80 backdrop-blur-xl rounded-[2rem] sm:rounded-[3.5rem] shadow-[0_20px_60px_rgba(0,0,0,0.03)] border border-white p-6 sm:p-10 flex-1 flex flex-col">

        <div class="flex flex-col gap-6 sm:gap-8 mb-8 sm:mb-10 px-1 sm:px-4">
            <div class="flex flex-row justify-between items-center sm:items-end gap-2 sm:gap-4">
                <div>
                    <div class="flex items-center gap-2 sm:gap-4 mb-1 sm:mb-2">
                        <span class="hidden sm:block w-8 sm:w-10 h-1.5 bg-indigo-600 rounded-full"></span>
                        <h3 class="text-xl sm:text-4xl font-black text-slate-800 tracking-tighter">Historial Global</h3>
                    </div>
                    <p class="hidden sm:block text-slate-400 text-xs sm:text-base font-medium sm:ml-14">Registro general de movimientos y cambios de dispositivos.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-slate-50/50 p-4 rounded-[2rem] border border-slate-100">
                <div class="relative">
                    <input wire:model.live="buscar" type="text" placeholder="Buscar por SN o descripción..."
                        class="w-full bg-white border-none rounded-2xl py-3 px-5 text-sm font-bold shadow-sm focus:ring-2 focus:ring-indigo-100 outline-none">
                </div>
                <select wire:model.live="estados"
                    class="bg-white border-none rounded-2xl py-3 px-5 text-sm font-bold shadow-sm focus:ring-2 focus:ring-indigo-100 outline-none appearance-none">
                    <option value="">Cualquier Estado</option>
                    <option value="Stock">Stock</option>
                    <option value="Roto">Roto</option>
                    <option value="Campo">Campo</option>
                    <option value="Preparado">Preparado</option>
                </select>

                <button wire:click="limpiarFiltros"
                    class="bg-slate-800 text-white rounded-2xl font-bold text-sm hover:bg-black transition-all py-3">Limpiar Filtros</button>
            </div>
        </div>

        @if ($historial->count())
            <div class="overflow-x-auto flex-1">
                <table class="w-full border-separate border-spacing-y-4">
                    <thead>
                        <tr class="text-slate-400">
                            <th class="px-4 sm:px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-left whitespace-nowrap">Fecha</th>
                            <th class="px-4 sm:px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-left whitespace-nowrap">Móvil (SN)</th>
                            <th class="px-4 sm:px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-left whitespace-nowrap">Modelo</th>
                            <th class="px-4 sm:px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-left whitespace-nowrap">Movimiento / Descripción</th>
                            <th class="px-4 sm:px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-center whitespace-nowrap">Estado</th>
                            <th class="px-4 sm:px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-left whitespace-nowrap">Empresa Destino</th>
                            <th class="sticky right-0 z-10 bg-white/80 backdrop-blur-xl px-4 sm:px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-right whitespace-nowrap">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($historial as $item)
                            <tr class="group">
                                <td class="bg-slate-50/50 group-hover:bg-white px-4 sm:px-6 py-4 sm:py-5 rounded-l-[1.5rem] sm:rounded-l-[2rem] transition-all border-y border-l border-transparent group-hover:border-slate-100 text-xs font-black text-slate-400 whitespace-nowrap">
                                    {{ $item->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="bg-slate-50/50 group-hover:bg-white px-4 sm:px-6 py-4 sm:py-5 transition-all border-y border-transparent group-hover:border-slate-100 text-sm font-black text-slate-700 whitespace-nowrap">
                                    {{ $item->movil->codigo ?? 'N/A' }}
                                </td>
                                <td class="bg-slate-50/50 group-hover:bg-white px-4 sm:px-6 py-4 sm:py-5 transition-all border-y border-transparent group-hover:border-slate-100 font-bold text-slate-500 whitespace-nowrap">
                                    {{ $item->movil->modelo->nombre ?? 'N/A' }}
                                </td>
                                <td class="bg-slate-50/50 group-hover:bg-white px-4 sm:px-6 py-4 sm:py-5 transition-all border-y border-transparent group-hover:border-slate-100 text-sm font-bold text-slate-600">
                                    {{ $item->descripcion }}
                                </td>
                                <td class="bg-slate-50/50 group-hover:bg-white px-4 sm:px-6 py-4 sm:py-5 transition-all border-y border-transparent group-hover:border-slate-100 text-center whitespace-nowrap">
                                    @php
                                        $config = match ($item->estado) {
                                            'Stock' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'dot' => 'bg-emerald-500'],
                                            'Roto' => ['bg' => 'bg-red-50', 'text' => 'text-red-600', 'dot' => 'bg-red-500'],
                                            'Campo' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'dot' => 'bg-blue-500'],
                                            'Preparado' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'dot' => 'bg-amber-500'],
                                            default => ['bg' => 'bg-slate-50', 'text' => 'text-slate-600', 'dot' => 'bg-slate-500'],
                                        };
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black uppercase {{ $config['bg'] }} {{ $config['text'] }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $config['dot'] }}"></span>
                                        {{ $item->estado ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="bg-slate-50/50 group-hover:bg-white px-4 sm:px-6 py-4 sm:py-5 transition-all border-y border-transparent group-hover:border-slate-100 font-bold text-slate-500 whitespace-nowrap">
                                    {{ $item->empresa->nombre ?? 'N/A' }}
                                </td>
                                <td class="sticky right-0 z-10 bg-white/90 backdrop-blur-md px-4 sm:px-6 py-4 sm:py-5 rounded-r-[1.5rem] sm:rounded-r-[2rem] transition-all border-y border-r border-transparent group-hover:border-slate-100 text-right whitespace-nowrap shadow-[-10px_0_15px_-3px_rgba(0,0,0,0.02)]">
                                    <div class="flex justify-end gap-2 opacity-30 group-hover:opacity-100 transition-all">
                                        @if($item->albaran_id)
                                            <a href="{{ route('albaran', ['edit' => $item->albaran_id]) }}" title="Ver/Editar Albarán"
                                                class="p-2.5 bg-white text-indigo-600 hover:bg-indigo-600 hover:text-white rounded-xl shadow-sm border border-slate-50 transition-all flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <button wire:click="descargarPDF({{ $item->albaran_id }})" title="Descargar PDF"
                                                class="p-2.5 bg-white text-blue-600 hover:bg-blue-600 hover:text-white rounded-xl shadow-sm border border-slate-50 transition-all flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                            </button>
                                        @else
                                            <span class="text-slate-300 text-xs font-semibold px-4 py-2 italic">Sin albarán</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $historial->links() }}
            </div>
        @else
            <x-mios.advertencia>
                No se encontraron movimientos con los filtros aplicados.
            </x-mios.advertencia>
        @endif
    </div>
</div>
