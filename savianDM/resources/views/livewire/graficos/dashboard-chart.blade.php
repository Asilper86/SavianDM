<div class="flex flex-col items-center w-full h-full group">
    <div class="mb-6 w-full max-w-xs">
        <select wire:model.live="empresaId"
            class="w-full bg-white dark:bg-gray-800 border-none text-gray-600 dark:text-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-cyan-500 py-3 px-4 transition-all cursor-pointer text-sm font-medium">
            <option value="">🌍 Todas las Empresas</option>
            @foreach ($empresas as $empresa)
                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div
        class="bg-white dark:bg-gray-900 p-8 rounded-[2.5rem] shadow-xl border border-white dark:border-white/5 w-full flex flex-col items-center justify-center min-h-[280px] relative transition-all hover:shadow-2xl hover:shadow-cyan-500/5">

        <p class="text-[10px] font-bold text-gray-400 dark:text-cyan-400 uppercase tracking-[0.2em] mb-6">Distribución
            Stock</p>

        <div class="relative w-44 h-44">
            <canvas id="movilesChart" wire:ignore></canvas>

            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Centros</span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:navigated', () => {
            const ctx = document.getElementById('movilesChart');
            let myChart;

            function renderChart(labels, data) {
                if (myChart) {
                    myChart.destroy();
                }

                myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: ['#07CBBB', '#6366F1', '#F59E0B', '#10B981', '#EF4444',
                                '#8B5CF6'
                            ],
                            borderWidth: 5,
                            borderColor: document.documentElement.classList.contains('dark') ?
                                '#111827' : '#fff',
                            hoverOffset: 20,
                            borderRadius: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '78%',
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: '#1f2937',
                                padding: 12,
                                cornerRadius: 10,
                                displayColors: true
                            }
                        }
                    }
                });
            }

            renderChart(@json($labels), @json($valores));

            Livewire.on('chartUpdated', (event) => {
                renderChart(event.labels, event.values);
            });
        });

        // Dentro de tu script del gráfico
        window.addEventListener('chartDataUpdated', event => {
            const labels = event.detail.labels;
            const data = event.detail.data;

            // Aquí actualizas tu instancia de Chart.js
            myChart.data.labels = labels;
            myChart.data.datasets[0].data = data;
            myChart.update();
        });
    </script>
</div>
