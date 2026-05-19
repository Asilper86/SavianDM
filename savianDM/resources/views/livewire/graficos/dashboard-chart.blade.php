<div class="space-y-10 p-3">

    {{-- ===== TARJETAS DE ESTADÍSTICAS ===== --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">

        {{-- Total --}}
        <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-6 border border-white shadow-sm hover:shadow-xl transition-all group">
            <div class="flex flex-col gap-3">
                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white text-lg shadow-lg">
                    <i class="fas fa-mobile-screen"></i>
                </div>
                <div>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tighter">{{ count($moviles) }}</h3>
                </div>
            </div>
        </div>

        {{-- En Stock --}}
        <div class="bg-[#07CBBB] rounded-[2.5rem] p-6 border border-[#07CBBB] shadow-lg shadow-[#07CBBB]/20 group relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
            <div class="flex flex-col gap-3 relative z-10">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center text-white text-lg border border-white/30">
                    <i class="fas fa-boxes-packing"></i>
                </div>
                <div>
                    <p class="text-[9px] font-black text-white/70 uppercase tracking-[0.2em] mb-1">En Stock</p>
                    <h3 class="text-3xl font-black text-white tracking-tighter">
                        {{ $moviles->where('estado', 'Stock')->count() }}
                    </h3>
                </div>
            </div>
        </div>

        {{-- En Campo --}}
        <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-6 border border-white shadow-sm hover:shadow-md transition-all group">
            <div class="flex flex-col gap-3">
                <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 text-lg border border-slate-100 group-hover:bg-[#07CBBB] group-hover:text-white transition-colors">
                    <i class="fas fa-user-check"></i>
                </div>
                <div>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">En Campo</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tighter">
                        {{ $moviles->where('estado', 'Campo')->count() }}
                    </h3>
                </div>
            </div>
        </div>

        {{-- Asignados --}}
        <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-6 border border-white shadow-sm hover:shadow-md transition-all group">
            <div class="flex flex-col gap-3">
                <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 text-lg border border-slate-100 group-hover:bg-[#07CBBB] group-hover:text-white transition-colors">
                    <i class="fas fa-hand-holding-hand"></i>
                </div>
                <div>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Asignados</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tighter">
                        {{ $moviles->where('estado', 'Preparado')->count() }}
                    </h3>
                </div>
            </div>
        </div>

        {{-- Rotos --}}
        <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-6 border border-white shadow-sm hover:shadow-md transition-all group">
            <div class="flex flex-col gap-3">
                <div class="w-12 h-12 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-500 text-lg border border-rose-100 group-hover:bg-rose-500 group-hover:text-white transition-colors">
                    <i class="fas fa-screwdriver-wrench"></i>
                </div>
                <div>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Rotos</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tighter">
                        {{ $moviles->where('estado', 'Roto')->count() }}
                    </h3>
                </div>
            </div>
        </div>

    </div>

    {{-- ===== DISTRIBUCIÓN POR EMPRESA ===== --}}
    <div class="bg-white/80 backdrop-blur-xl rounded-[3.5rem] p-10 border border-white shadow-sm">

        <div class="flex justify-between items-end mb-10">
            <div>
                <h3 class="text-2xl font-black text-slate-900 tracking-tighter">Distribución por Empresa</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">
                    Carga de dispositivos por cliente
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            @foreach ($empresas as $item)

                <div
                    class="bg-slate-50/50 hover:bg-slate-50/90 border border-slate-100 hover:border-slate-200 p-5 rounded-3xl shadow-sm hover:shadow-md transition-all duration-300"
                    x-data="{ abierto: false }"
                >
                    {{-- Cabecera clicable --}}
                    <div
                        class="flex justify-between items-center cursor-pointer group"
                        @click="abierto = !abierto"
                    >
                        <div class="flex items-center gap-2">
                            <i class="fas fa-building text-slate-400 group-hover:text-[#07CBBB] transition-colors text-xs"></i>
                            <span class="text-sm font-bold text-slate-700 uppercase tracking-tight group-hover:text-slate-900 transition-colors">
                                {{ $item->nombre }}
                            </span>
                            <svg
                                class="w-4 h-4 text-slate-400 transition-transform duration-300"
                                :class="abierto ? 'rotate-180 text-[#07CBBB]' : ''"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        <span class="text-lg font-black text-slate-900 tracking-tighter">
                            {{ $item->movils_count }}
                        </span>
                    </div>

                    {{-- Barra de progreso --}}
                    <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden mt-3">
                        <div
                            class="bg-[#07CBBB] h-full rounded-full shadow-[0_0_10px_rgba(7,203,187,0.3)] transition-all duration-500"
                            style="width: {{ count($moviles) > 0 ? ($item->movils_count / count($moviles)) * 100 : 0 }}%"
                        ></div>
                    </div>

                    {{-- Desplegable: Centros de Trabajo --}}
                    <div x-show="abierto" x-collapse x-cloak class="mt-4 pt-3 border-t border-slate-100">

                        <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-1.5">
                            <span class="w-1 h-1 bg-[#07CBBB] rounded-full"></span>
                            Distribución por centro
                        </div>

                        <div class="space-y-2">
                            @forelse ($item->centrosTrabajo as $centro)
                                <div class="flex justify-between items-center bg-white hover:bg-[#07CBBB]/5 px-3 py-2 rounded-xl border border-slate-100 hover:border-[#07CBBB]/20 transition-all duration-200">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-map-marker-alt text-slate-300 text-[10px]"></i>
                                        <span class="text-xs font-semibold text-slate-600">{{ $centro->nombre }}</span>
                                    </div>
                                    <span class="px-2.5 py-0.5 bg-[#07CBBB]/10 text-[#07CBBB] rounded-full text-[10px] font-bold">
                                        {{ $centro->movils_count }} {{ $centro->movils_count == 1 ? 'móvil' : 'móviles' }}
                                    </span>
                                </div>
                            @empty
                                <div class="text-xs text-slate-400 italic px-2 flex items-center gap-1.5">
                                    <i class="fas fa-info-circle text-slate-300"></i>
                                    No hay centros asociados.
                                </div>
                            @endforelse
                        </div>

                    </div>
                </div>

            @endforeach

        </div>
    </div>

    {{-- ===== MÓDULO GEOLOCALIZACIÓN ===== --}}
    <div class="relative group overflow-hidden bg-slate-900 rounded-[3.5rem] min-h-[450px] flex items-center justify-center border border-slate-800 shadow-2xl">

        {{-- Fondo de puntos --}}
        <div
            class="absolute inset-0 opacity-20"
            style="background-image: radial-gradient(#07CBBB 1px, transparent 1px); background-size: 30px 30px;"
        ></div>

        <div class="absolute w-96 h-96 bg-[#07CBBB]/10 rounded-full blur-[120px]"></div>

        {{-- Contenido central --}}
        <div class="relative z-10 text-center px-6">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2rem] text-[#07CBBB] text-3xl mb-6 shadow-2xl group-hover:scale-110 transition-transform duration-500">
                <i class="fas fa-map-location-dot"></i>
            </div>
            <h4 class="text-2xl font-black text-white tracking-tighter mb-3 uppercase">
                Geolocalización en tiempo real
            </h4>
            <p class="text-[10px] font-black text-[#07CBBB] uppercase tracking-[0.4em] mb-8 opacity-70">
                Módulo en fase de implementación
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <div class="px-6 py-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Estado</p>
                    <p class="text-xs font-black text-white uppercase">Sincronizando Nodos</p>
                </div>
                <div class="px-6 py-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Protocolo</p>
                    <p class="text-xs font-black text-white uppercase">GPS-Savian-v3</p>
                </div>
            </div>
        </div>

        {{-- Esquinas decorativas --}}
        <div class="absolute top-10 left-10 w-4 h-4 border-t-2 border-l-2 border-[#07CBBB]/30"></div>
        <div class="absolute top-10 right-10 w-4 h-4 border-t-2 border-r-2 border-[#07CBBB]/30"></div>
        <div class="absolute bottom-10 left-10 w-4 h-4 border-b-2 border-l-2 border-[#07CBBB]/30"></div>
        <div class="absolute bottom-10 right-10 w-4 h-4 border-b-2 border-r-2 border-[#07CBBB]/30"></div>

    </div>

</div>