<div class="space-y-10 p-3">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">

        <div
            class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-6 border border-white shadow-sm hover:shadow-xl transition-all group">
            <div class="flex flex-col gap-3">
                <div
                    class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white text-lg shadow-lg">
                    <i class="fas fa-mobile-screen"></i>
                </div>
                <div>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tighter">{{ count($moviles) }}</h3>
                </div>
            </div>
        </div>

        <div
            class="bg-[#07CBBB] rounded-[2.5rem] p-6 border border-[#07CBBB] shadow-lg shadow-[#07CBBB]/20 group relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
            <div class="flex flex-col gap-3 relative z-10">
                <div
                    class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center text-white text-lg border border-white/30">
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

        <div
            class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-6 border border-white shadow-sm hover:shadow-md transition-all group">
            <div class="flex flex-col gap-3">
                <div
                    class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 text-lg border border-slate-100 group-hover:bg-[#07CBBB] group-hover:text-white transition-colors">
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

        <div
            class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-6 border border-white shadow-sm hover:shadow-md transition-all group">
            <div class="flex flex-col gap-3">
                <div
                    class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 text-lg border border-slate-100 group-hover:bg-[#07CBBB] group-hover:text-white transition-colors">
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

        <div
            class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-6 border border-white shadow-sm hover:shadow-md transition-all group">
            <div class="flex flex-col gap-3">
                <div
                    class="w-12 h-12 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-500 text-lg border border-rose-100 group-hover:bg-rose-500 group-hover:text-white transition-colors">
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

    <div class="bg-white/80 backdrop-blur-xl rounded-[3.5rem] p-10 border border-white shadow-sm">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h3 class="text-2xl font-black text-slate-900 tracking-tighter">Distribución por Empresa</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Carga de dispositivos por
                    cliente</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($empresas as $item)
                <div class="space-y-4">
                    <div class="flex justify-between items-end">
                        <span class="text-sm font-black text-slate-700 uppercase">{{ $item->nombre }}</span>
                        <span
                            class="text-xl font-black text-slate-900 tracking-tighter">{{ $item->movils_count }}</span>
                    </div>
                    <div class="w-full bg-slate-100 h-4 rounded-full overflow-hidden p-1">
                        <div class="bg-[#07CBBB] h-full rounded-full shadow-[0_0_15px_rgba(7,203,187,0.4)]"
                            style="width: {{ count($moviles) > 0 ? ($item->movils_count / count($moviles)) * 100 : 0 }}%">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div
        class="relative group overflow-hidden bg-slate-900 rounded-[3.5rem] min-h-[450px] flex items-center justify-center border border-slate-800 shadow-2xl">

        <div class="absolute inset-0 opacity-20"
            style="background-image: radial-gradient(#07CBBB 1px, transparent 1px); background-size: 30px 30px;">
        </div>

        <div class="absolute w-96 h-96 bg-[#07CBBB]/10 rounded-full blur-[120px]"></div>

        <div class="relative z-10 text-center px-6">
            <div
                class="inline-flex items-center justify-center w-20 h-20 bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2rem] text-[#07CBBB] text-3xl mb-6 shadow-2xl group-hover:scale-110 transition-transform duration-500">
                <i class="fas fa-map-location-dot"></i>
            </div>

            <h4 class="text-2xl font-black text-white tracking-tighter mb-3 uppercase">Geolocalización en tiempo real
            </h4>
            <p class="text-[10px] font-black text-[#07CBBB] uppercase tracking-[0.4em] mb-8 opacity-70">Módulo en fase
                de implementación</p>

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

        <div class="absolute top-10 left-10 w-4 h-4 border-t-2 border-l-2 border-[#07CBBB]/30"></div>
        <div class="absolute top-10 right-10 w-4 h-4 border-t-2 border-r-2 border-[#07CBBB]/30"></div>
        <div class="absolute bottom-10 left-10 w-4 h-4 border-b-2 border-l-2 border-[#07CBBB]/30"></div>
        <div class="absolute bottom-10 right-10 w-4 h-4 border-b-2 border-r-2 border-[#07CBBB]/30"></div>
    </div>
</div> ```


</div>
