<?php

namespace App\Livewire\Graficos;

use Livewire\Component;
use App\Models\Empresa;
use Livewire\Attributes\On;

class DashboardChart extends Component
{
    public $searchEmpresa = '';
    public $searchCentro = '';

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
        // Obtenemos las empresas con el conteo de móviles para el gráfico
        $empresas = Empresa::query()
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

        return view('livewire.graficos.dashboard-chart', compact('empresas'));
    }
}