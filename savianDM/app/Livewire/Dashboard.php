<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Movil;
use App\Models\Historial;

class Dashboard extends Component
{
    // Propiedades públicas para los filtros
    public $searchEmpresa = '';
    public $searchCentro = '';
    public $searchFecha = '';

    public function render()
    {
        // Lógica de filtrado para Móviles
        $movilesCount = Movil::query()
            ->when($this->searchEmpresa, function($q) {
                $q->whereHas('empresa', fn($e) => $e->where('nombre', 'like', "%{$this->searchEmpresa}%"));
            })
            ->when($this->searchCentro, function($q) {
                $q->whereHas('centroTrabajo', fn($c) => $c->where('nombre', 'like', "%{$this->searchCentro}%"));
            })
            ->count();

        // Lógica de filtrado para Historial
        $historialCount = Historial::query()
            ->when($this->searchFecha, function($q) {
                $q->whereDate('created_at', $this->searchFecha);
            })
            ->count();
    
        $this->dispatch('filterUpdated', 
            empresa: $this->searchEmpresa, 
            centro: $this->searchCentro
        );
        // USANDO COMPACT: Pasamos las variables a la vista
        return view('livewire.dashboard', compact('movilesCount', 'historialCount'))
            ->layout('components.layouts.app');
    }
}