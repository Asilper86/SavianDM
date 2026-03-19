<x-mios.base>
    <div class="min-h-screen bg-[#F3F4F9] dark:bg-gray-950 transition-colors duration-500">

        <div
            class="bg-[#07CBBB] dark:bg-cyan-900/40 dark:backdrop-blur-xl py-4 shadow-lg shadow-cyan-200 dark:shadow-none border-b dark:border-cyan-800/50">
            <div class="max-w-[95%] mx-auto px-2 flex flex-col md:flex-row gap-4 justify-center">
                <input type="text" placeholder="Empresa"
                    class="md:w-72 bg-white/30 dark:bg-gray-800/40 border-none dark:border dark:border-white/10 placeholder-white/80 text-white rounded-xl focus:ring-2 focus:ring-white/50 backdrop-blur-sm transition-all shadow-sm">
                <input type="text" placeholder="Centro"
                    class="md:w-72 bg-white/30 dark:bg-gray-800/40 border-none dark:border dark:border-white/10 placeholder-white/80 text-white rounded-xl focus:ring-2 focus:ring-white/50 backdrop-blur-sm transition-all shadow-sm">
                <input type="date" placeholder="Fecha"
                    class="md:w-72 bg-white/30 dark:bg-gray-800/40 border-none dark:border dark:border-white/10 placeholder-white/80 text-white rounded-xl focus:ring-2 focus:ring-white/50 backdrop-blur-sm transition-all shadow-sm">
            </div>
        </div>

        <main class="max-w-[95%] mx-auto px-2 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-center">
                
                    <div
                        class="bg-[#DDE1E9] dark:bg-gray-900 p-10 rounded-[2rem] shadow-xl border border-white dark:border-white/5 text-center transition-all hover:scale-105 hover:shadow-2xl hover:shadow-indigo-500/10">
                        <p class="text-sm font-bold text-gray-500 dark:text-indigo-400 uppercase tracking-widest mb-4">
                            Total Móviles</p>
                        <p class="text-6xl font-black text-gray-800 dark:text-gray-100 tracking-tighter">
                            {{ number_format($moviles) }}</p>
                    </div>
                


                <div class="flex flex-col items-center">
                    <p class="text-sm font-bold text-gray-600 dark:text-gray-400 mb-6 uppercase tracking-tighter">
                        Móviles-Centro</p>
                    <div
                        class="relative w-48 h-48 rounded-full bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-800 dark:to-gray-900 shadow-inner flex items-center justify-center border-[12px] border-white dark:border-gray-800 shadow-2xl dark:shadow-indigo-500/10">
                        <div class="text-center">
                            <span
                                class="block text-xs font-bold text-gray-400 dark:text-gray-500 uppercase">Gráfico</span>
                            <div class="h-1 w-8 bg-indigo-500 mx-auto mt-1 rounded-full">
                                @livewire('graficos.dashboard-chart')
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-[#DDE1E9] dark:bg-gray-900 p-10 rounded-[2rem] shadow-xl border border-white dark:border-white/5 text-center transition-all hover:scale-105 hover:shadow-2xl hover:shadow-indigo-500/10">
                    <p class="text-sm font-bold text-gray-500 dark:text-indigo-400 uppercase tracking-widest mb-4">Total
                        Movimientos</p>
                    <p class="text-6xl font-black text-gray-800 dark:text-gray-100 tracking-tighter">{{ number_format($historial) }}</p>
                </div>
            </div>

            <div
                class="mt-16 relative overflow-hidden bg-[#FFC107] dark:bg-amber-600/90 h-[500px] rounded-[3rem] shadow-2xl border-[16px] border-white dark:border-gray-900 group">
                <div class="absolute inset-0 flex items-center justify-center">
                    <h2
                        class="text-[14rem] font-black text-black/10 dark:text-white/5 select-none transition-transform group-hover:scale-105 duration-700">
                        MAPA</h2>
                </div>
                <div class="absolute top-6 right-6 flex flex-col space-y-2">
                    <button
                        class="w-12 h-12 bg-white dark:bg-gray-800 dark:text-white rounded-xl shadow-lg flex items-center justify-center font-bold text-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">+</button>
                    <button
                        class="w-12 h-12 bg-white dark:bg-gray-800 dark:text-white rounded-xl shadow-lg flex items-center justify-center font-bold text-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">-</button>
                </div>
            </div>
        </main>
    </div>
</x-mios.base>
