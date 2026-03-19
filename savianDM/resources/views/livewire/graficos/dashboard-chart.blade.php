<div class="flex flex-col items-center w-full">
    <div class="mb-8 w-full max-w-xs">
        <select wire:model.live="empresaId" class="w-full bg-white/20 dark:bg-gray-800/40 border-none text-gray-700 dark:text-white rounded-xl focus:ring-2 focus:ring-cyan-500 backdrop-blur-md shadow-sm text-sm p-3 transition-all cursor-pointer">
            <option value="" class="text-gray-800">🌍 Todas las Empresas</option>
            @foreach($empresas as $empresa)
                <option value="{{ $empresa->id }}" class="text-gray-800">{{ $empresa->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="relative w-64 h-64 flex items-center justify-center bg-white dark:bg-gray-900 rounded-[2.5rem] shadow-2xl border border-white dark:border-white/5 p-4 group transition-transform hover:scale-105">
        <canvas id="movilesChart" wire:ignore></canvas>
        
        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Stock</span>
            <span class="text-xl font-black text-cyan-600 dark:text-cyan-400">Centros</span>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:navigated', () => {
            const ctx = document.getElementById('movilesChart');
            let myChart;

            function renderChart(labels, data) {
                if (myChart) { myChart.destroy(); }
                
                myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: ['#07CBBB', '#6366F1', '#F59E0B', '#10B981', '#EF4444', '#8B5CF6'],
                            borderWidth: 4,
                            borderColor: document.documentElement.classList.contains('dark') ? '#111827' : '#fff',
                            hoverOffset: 15,
                            borderRadius: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '75%', // Hace el hueco central para estilo Donut
                        plugins: {
                            legend: { display: false }, // Ocultamos leyenda para que sea más limpio
                            tooltip: {
                                backgroundColor: '#1f2937',
                                titleFont: { size: 14 },
                                padding: 12,
                                cornerRadius: 10,
                                displayColors: true
                            }
                        }
                    }
                });
            }

            // Inicialización
            renderChart(@json($labels), @json($valores));

            // Escuchar cambios de Livewire
            Livewire.on('chartUpdated', (event) => {
                renderChart(event.labels, event.values);
            });
        });
    </script>
</div>