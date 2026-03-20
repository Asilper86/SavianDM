<x-mios.base>
    <div class="min-h-screen bg-[#F3F4F9] dark:bg-gray-950 transition-colors duration-500 pb-12">
        
        <div class="sticky top-0 z-40 bg-[#07CBBB]/90 dark:bg-cyan-950/80 backdrop-blur-md border-b border-white/20 dark:border-white/5 shadow-xl">
            <div class="max-w-[98%] mx-auto px-6 py-4 flex flex-col md:flex-row gap-6 justify-center items-center">
                <div class="relative group w-full md:w-72">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-white/50 text-xs uppercase font-bold">Empresa</span>
                    <input type="text" placeholder="Buscar..." class="w-full pl-20 bg-white/10 border border-white/20 text-white placeholder-white/40 rounded-2xl focus:ring-2 focus:ring-white/50 focus:bg-white/20 backdrop-blur-sm transition-all py-3 shadow-inner text-sm">
                </div>
                <div class="relative group w-full md:w-72">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-white/50 text-xs uppercase font-bold">Centro</span>
                    <input type="text" placeholder="Filtrar..." class="w-full pl-20 bg-white/10 border border-white/20 text-white placeholder-white/40 rounded-2xl focus:ring-2 focus:ring-white/50 focus:bg-white/20 backdrop-blur-sm transition-all py-3 shadow-inner text-sm">
                </div>
                <div class="relative group w-full md:w-72">
                    <input type="date" class="w-full bg-white/10 border border-white/20 text-white rounded-2xl focus:ring-2 focus:ring-white/50 backdrop-blur-sm py-3 px-4 shadow-inner text-sm appearance-none">
                </div>
            </div>
        </div>

        <main class="max-w-[98%] mx-auto px-4 mt-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                
                <div class="relative overflow-hidden bg-white dark:bg-gray-900 p-10 rounded-[3rem] shadow-2xl border border-white dark:border-white/5 flex flex-col justify-between transition-all hover:scale-[1.02] duration-500 group">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-indigo-500/10 rounded-full blur-3xl group-hover:bg-indigo-500/20 transition-colors"></div>
                    <div>
                        <p class="text-[10px] font-black text-indigo-500 dark:text-indigo-400 uppercase tracking-[0.3em] mb-2">Inventario Global</p>
                        <h3 class="text-gray-400 dark:text-gray-500 text-sm font-medium">Total Móviles</h3>
                    </div>
                    <div class="my-8">
                        <p class="text-8xl font-black text-gray-800 dark:text-white tracking-tighter leading-none">
                            {{ number_format($moviles) }}
                        </p>
                    </div>
                    <div class="flex items-center gap-2 text-[10px] font-bold text-emerald-500 bg-emerald-500/10 w-fit px-3 py-1 rounded-full uppercase">
                        <span>●</span> Activos en sistema
                    </div>
                </div>

                <div class="flex flex-col items-center">
                    @livewire('graficos.dashboard-chart')
                </div>

                <div class="relative overflow-hidden bg-white dark:bg-gray-900 p-10 rounded-[3rem] shadow-2xl border border-white dark:border-white/5 flex flex-col justify-between transition-all hover:scale-[1.02] duration-500 group">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-cyan-500/10 rounded-full blur-3xl group-hover:bg-cyan-500/20 transition-colors"></div>
                    <div>
                        <p class="text-[10px] font-black text-cyan-500 dark:text-cyan-400 uppercase tracking-[0.3em] mb-2">Flujo de Activos</p>
                        <h3 class="text-gray-400 dark:text-gray-500 text-sm font-medium">Movimientos Totales</h3>
                    </div>
                    <div class="my-8">
                        <p class="text-8xl font-black text-gray-800 dark:text-white tracking-tighter leading-none">
                            {{ number_format($historial) }}
                        </p>
                    </div>
                    <div class="flex items-center gap-2 text-[10px] font-bold text-cyan-500 bg-cyan-500/10 w-fit px-3 py-1 rounded-full uppercase">
                        <span>●</span> Historial Registrado
                    </div>
                </div>
            </div>

            <div class="mt-12 group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-cyan-500 to-indigo-500 rounded-[3.5rem] blur opacity-20 group-hover:opacity-40 transition duration-1000"></div>
                <div class="relative h-[600px] bg-white dark:bg-gray-900 rounded-[3.5rem] shadow-2xl border-[12px] border-white dark:border-gray-800 overflow-hidden">
                    <div class="absolute inset-0 bg-[#FFC107]/10 dark:bg-amber-500/5 flex items-center justify-center">
                        <h2 class="text-[15rem] font-black text-black/[0.03] dark:text-white/[0.03] select-none uppercase tracking-tighter">Explorar</h2>
                    </div>
                    <div class="absolute bottom-10 right-10 flex flex-col gap-3">
                        <button class="w-14 h-14 bg-white dark:bg-gray-800 shadow-2xl rounded-2xl flex items-center justify-center text-2xl font-light hover:bg-cyan-500 hover:text-white transition-all transform active:scale-90 border border-gray-100 dark:border-white/5">+</button>
                        <button class="w-14 h-14 bg-white dark:bg-gray-800 shadow-2xl rounded-2xl flex items-center justify-center text-2xl font-light hover:bg-cyan-500 hover:text-white transition-all transform active:scale-90 border border-gray-100 dark:border-white/5">-</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-mios.base>