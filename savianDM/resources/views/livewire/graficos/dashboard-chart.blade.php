<div class="flex flex-col items-center w-full h-full group animate-fade-in-up">
    <div
        class="bg-white/80 backdrop-blur-xl dark:bg-gray-900/80 p-8 rounded-[2.5rem] shadow-[0_20px_50px_-12px_rgba(0,0,0,0.1)] border border-white/50 dark:border-white/5 w-full flex flex-col items-center justify-center min-h-[320px] relative transition-all duration-500 hover:shadow-[0_20px_50px_-12px_rgba(6,182,212,0.15)] hover:-translate-y-1">

        <div class="w-full flex justify-between items-center mb-6 px-2">
            <p class="text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-[0.25em]">
                Distribución <span class="text-cyan-500 font-bold">Stock</span>
            </p>
            <div class="h-2 w-2 rounded-full bg-cyan-400 animate-pulse"></div>
        </div>

        <div class="relative w-56 h-56 flex items-center justify-center">
            <canvas id="movilesChart" wire:ignore class="drop-shadow-md"></canvas>

            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                <span class="text-[10px] font-black text-gray-400/80 dark:text-gray-500 uppercase tracking-widest mt-1">{{ $empresaId ? 'Centros' : 'Empresas' }}</span>
                <span class="text-3xl font-black text-slate-700 dark:text-white mt-1">{{ collect($valores)->sum() }}</span>
            </div>
        </div>
    </div>

    <!-- Cargar Chart.js si no estuviere -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Usar VAR previene errores si Livewire re-inyecta este script multiple veces
        var myChartInstance = myChartInstance || null;

        var initChart = function() {
            const ctx = document.getElementById('movilesChart');
            if (!ctx) return;
            
            // Evitar reinicialización múltiple en la misma vista
            if (myChartInstance) {
                myChartInstance.destroy();
            }

            myChartInstance = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        data: @json($valores),
                        backgroundColor: [
                            '#06b6d4', '#6366f1', '#f59e0b', '#10b981', '#f43f5e', '#8b5cf6', '#3b82f6', '#14b8a6'
                        ],
                        borderWidth: 4,
                        borderColor: document.documentElement.classList.contains('dark') ? '#111827' : '#ffffff',
                        hoverOffset: 12,
                        borderRadius: 6,
                        spacing: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '82%',
                    animation: {
                        animateScale: true,
                        animateRotate: true,
                        duration: 1200,
                        easing: 'easeOutQuart'
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)',
                            titleColor: '#fff',
                            bodyColor: '#cbd5e1',
                            padding: 12,
                            cornerRadius: 12,
                            displayColors: true,
                            usePointStyle: true,
                            boxPadding: 6,
                            borderColor: 'rgba(255,255,255,0.1)',
                            borderWidth: 1
                        }
                    }
                }
            });
        };

        document.addEventListener('livewire:navigated', () => {
            initChart();
        });
        
        // Fallback por si livewire:navigated ya pasó o es carga normal
        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            setTimeout(initChart, 100);
        } else {
            document.addEventListener('DOMContentLoaded', initChart);
        }

        // Listener global corregido
        if (!window.chartDataUpdatedListenerAttached) {
            window.chartDataUpdatedListenerAttached = true;
            window.addEventListener('chartDataUpdated', event => {
                let detail = event.detail;
                if (Array.isArray(detail)) {
                    detail = detail[0];
                }
                const labels = detail.labels;
                const data = detail.data;

                if (myChartInstance && labels && data) {
                    myChartInstance.data.labels = Object.values(labels);
                    myChartInstance.data.datasets[0].data = Object.values(data);
                    myChartInstance.update();
                }
            });
        }
    </script>
</div>
