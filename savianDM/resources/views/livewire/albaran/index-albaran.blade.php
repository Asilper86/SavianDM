<div class="w-full min-h-screen bg-slate-100 p-3 sm:p-6 md:p-10 flex flex-col font-sans antialiased">
    <!-- Contenedor Principal Ultra Redondeado con Efecto Glass y Sombra Profunda -->
    <div class="bg-white/90 backdrop-blur-2xl rounded-[2.5rem] sm:rounded-[4rem] shadow-[0_25px_70px_rgba(0,0,0,0.04)] border border-white p-5 sm:p-12 flex-1 flex flex-col overflow-hidden">

        <!-- Encabezado de la Vista -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 sm:mb-12 gap-6 px-1 sm:px-3">
            <div>
                <div class="flex items-center gap-4 mb-2">
                    <span class="w-10 h-2 bg-slate-800 rounded-full"></span>
                    <h3 class="text-2xl sm:text-4xl font-black text-slate-800 tracking-wide uppercase">Registro de Albaranes</h3>
                </div>
                <p class="text-slate-400 text-xs sm:text-sm font-bold tracking-wider uppercase ml-14">Gestión integral de entradas y salidas.</p>
            </div>

            <div class="w-full sm:w-auto shrink-0 flex justify-end">
                @livewire('albaran.create-albaran')
            </div>
        </div>

        <!-- Contenedor de Tabla con Scroll Suave y Esquinas Redondeadas -->
        <div class="flex-1 overflow-auto rounded-[2rem] custom-scrollbar bg-slate-50/50 p-2 border border-slate-100">
            <table class="w-full border-separate border-spacing-y-3 px-2">
                <thead class="sticky top-0 bg-white/80 backdrop-blur-md z-10">
                    <tr class="text-slate-500">
                        <th class="bg-white px-6 py-4 text-[11px] font-black uppercase tracking-widest text-left whitespace-nowrap rounded-l-2xl">Nº Albarán</th>
                        <th class="bg-white px-6 py-4 text-[11px] font-black uppercase tracking-widest text-left whitespace-nowrap">Fecha</th>
                        <th class="bg-white px-6 py-4 text-[11px] font-black uppercase tracking-widest text-left whitespace-nowrap">Estado</th>
                        <th class="bg-white px-6 py-4 text-[11px] font-black uppercase tracking-widest text-right whitespace-nowrap rounded-r-2xl">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($albaran as $item)
                        <tr class="group transition-all duration-300">
                            <!-- ID / Nº Albarán -->
                            <td class="bg-white group-hover:bg-slate-50/80 px-6 py-5 rounded-l-3xl border-y border-l border-transparent text-xs font-black text-slate-600 italic whitespace-nowrap transition-colors">
                                #{{ $item->id }}
                            </td>
                            <!-- Fecha -->
                            <td class="bg-white group-hover:bg-slate-50/80 px-6 py-5 border-y border-transparent whitespace-nowrap transition-colors">
                                <div class="flex flex-col">
                                    <span class="text-sm font-black text-slate-800 tracking-tight">{{ $item->created_at }}</span>
                                </div>
                            </td>
                            <!-- Estado (Píldoras Dinámicas con Colores Seguros) -->
                            <td class="bg-white group-hover:bg-slate-50/80 px-6 py-5 border-y border-transparent whitespace-nowrap transition-colors">
                                @php
                                    $bgClass = match($item->estado) {
                                        'entregado' => 'bg-emerald-100 text-emerald-800',
                                        'retirado' => 'bg-rose-100 text-rose-800',
                                        default => 'bg-amber-100 text-amber-800',
                                    };
                                @endphp
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest {{ $bgClass }} shadow-sm">
                                    {{ $item->estado }}
                                </span>
                            </td>
                            <!-- Acciones -->
                            <td class="bg-white group-hover:bg-slate-50/80 px-6 py-5 rounded-r-3xl border-y border-r border-transparent text-right whitespace-nowrap transition-colors">
                                <div class="flex justify-end items-center gap-3">
                                    <!-- PDF -->
                                    <button wire:click="descargarPDF({{ $item->id }})" title="Descargar PDF" class="p-3 bg-slate-50 text-slate-700 hover:bg-[#07CBBB] hover:text-white rounded-2xl transition-all duration-200 border border-slate-100 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </button>
                                    <!-- Editar -->
                                    <button wire:click="$dispatchTo('albaran.create-albaran', 'editar-albaran', { id: {{ $item->id }} })" title="Editar Registro" class="p-3 bg-slate-50 text-slate-700 hover:bg-slate-800 hover:text-white rounded-2xl transition-all duration-200 border border-slate-100 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <!-- Eliminar -->
                                    <button wire:click="eliminarAlbaran({{ $item->id }})" wire:confirm="¿Seguro que deseas eliminar este albarán y su PDF?" title="Eliminar Albarán" class="p-3 bg-slate-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-2xl transition-all duration-200 border border-slate-100 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-24 text-slate-400 font-bold uppercase tracking-wider text-xs italic bg-white rounded-[2rem]">
                                No hay registros en el sistema.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación con amplitud -->
        <div class="mt-8 px-2">{{ $albaran->links() }}</div>
    </div>
</div>