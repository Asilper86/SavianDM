<div> 
    <div class="min-h-screen bg-slate-50 p-6">

        <div class="max-w-7xl mx-auto mb-10">
            <div class="bg-white border border-slate-200 rounded-[2.5rem] p-4 shadow-sm flex flex-col md:flex-row gap-4 items-center">

                <div class="relative flex-1 group">
                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-[10px] font-black text-cyan-600 uppercase tracking-widest">Empresa</span>
                    <input type="text" wire:model.live="searchEmpresa"
                        class="w-full pl-24 pr-4 py-3 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-cyan-500/20 transition-all"
                        placeholder="Buscar...">
                </div>

                <div class="relative flex-1 group">
                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-[10px] font-black text-cyan-600 uppercase tracking-widest">Centro</span>
                    <input type="text" wire:model.live="searchCentro"
                        class="w-full pl-24 pr-4 py-3 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-cyan-500/20 transition-all"
                        placeholder="Sede...">
                </div>

                <div class="w-full md:w-56">
                    <input type="date" wire:model.live="searchFecha"
                        class="w-full px-4 py-3 bg-slate-50 border-none rounded-2xl text-sm text-slate-400">
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-8 items-stretch">

            <div class="md:col-span-3 bg-white p-10 rounded-[3rem] shadow-xl border border-white text-center flex flex-col justify-center">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Stock de Móviles</p>
                <h2 class="text-8xl font-black text-slate-800 tracking-tighter">
                    {{ $moviles }}
                </h2>
            </div>

            <div class="md:col-span-6 bg-white p-8 rounded-[3rem] shadow-xl border border-white flex flex-col items-center">
                <div class="w-full flex justify-between px-4 mb-6">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">🌍 Distribución</span>
                    <span class="text-xs font-bold text-cyan-500">SAVIAN STOCK</span>
                </div>

                <div class="relative w-full flex justify-center">
                    @livewire('graficos.dashboard-chart')
                </div>
            </div>

            <div class="md:col-span-3 bg-white p-10 rounded-[3rem] shadow-xl border border-white text-center flex flex-col justify-center">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Movimientos</p>
                <h2 class="text-8xl font-black text-indigo-500 tracking-tighter">
                    {{ $historial }}
                </h2>
            </div>

        </div>
    </div>
</div> 