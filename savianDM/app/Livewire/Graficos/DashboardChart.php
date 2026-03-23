<?php

namespace App\Livewire\Graficos;

use Livewire\Component;
use App\Models\Empresa;
use Livewire\Attributes\On;

class DashboardChart extends Component
{
    public $searchEmpresa = '';
    public $searchCentro = '';
    public $empresaId = '';

    /**
     * Escucha el evento disparado desde el Dashboard principal
     */
    #[On('filterUpdated')]
    public function updateFilters($empresa = '', $centro = '')
    {
        $this->searchEmpresa = $empresa;
        $this->searchCentro = $centro;
    }

    public function render()
    {
        // Empresas para el select
        $empresas = Empresa::all();

        if ($this->empresaId) {
            // Un filtro de empresa está activo por el select
            // Mostrar los Centros de Trabajo de esa empresa
            $chartData = \App\Models\CentroTrabajo::query()
                ->where('empresa_id', $this->empresaId)
                ->when($this->searchCentro, function ($query) {
                    $query->where('nombre', 'like', "%{$this->searchCentro}%");
                })
                ->withCount('movils')
                ->get();

        } else {
            // Mostrar todas las empresas
            $chartData = Empresa::query()
                ->when($this->searchEmpresa, function ($q) {
                    $q->where('nombre', 'like', "%{$this->searchEmpresa}%");
                })
                ->withCount(['movils' => function ($q) {
                    $q->when($this->searchCentro, function ($query) {
                        $query->whereHas('centroTrabajo', fn($c) => 
                            $c->where('nombre', 'like', "%{$this->searchCentro}%")
                        );
                    });
                }])
                ->get();
        }

        $labels = $chartData->pluck('nombre');
        $valores = $chartData->pluck('movils_count');

        // Despachamos evento al frontend para actualizar ChartJS
        $this->dispatch('chartDataUpdated', labels: $labels, data: $valores);

        return view('livewire.graficos.dashboard-chart', compact('empresas', 'labels', 'valores'));
    }
}