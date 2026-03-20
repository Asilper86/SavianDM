<?php

namespace App\Livewire;

use App\Models\Historial;
use App\Models\Movil;
use Livewire\Component;

class Dashboard extends Component
{
    public $searchEmpresa = '';

    public $searchCentro = '';

    public $searchFecha = '';

    public function render()
    {
        $movilesQuery = Movil::query()
            ->when($this->searchEmpresa, function ($q) {
                $q->whereHas('empresa', fn ($e) => $e->where('nombre', 'like', '%'.$this->searchEmpresa.'%'));
            })
            ->when($this->searchCentro, function ($q) {
                $q->whereHas('centroTrabajo', fn ($c) => $c->where('nombre', 'like', '%'.$this->searchCentro.'%'));
            });

        // 2. Filtrar Total de Movimientos (Historial)
        $historialQuery = Historial::query()
            ->when($this->searchFecha, function ($q) {
                $q->whereDate('created_at', $this->searchFecha);
            })
            ->when($this->searchEmpresa, function ($q) {
                $q->whereHas('empresa', fn ($e) => $e->where('nombre', 'like', '%'.$this->searchEmpresa.'%'));
            });

        $this->dispatch('filterUpdated',
            empresa: $this->searchEmpresa,
            centro: $this->searchCentro,
            fecha: $this->searchFecha
        );

        return view('livewire.dashboard', [
            'moviles' => $movilesQuery->count(),
            'historial' => $historialQuery->count(),
        ]);
    }
}
