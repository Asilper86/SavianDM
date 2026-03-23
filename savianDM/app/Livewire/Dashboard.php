<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Movil;
use App\Models\Historial;

class Dashboard extends Component
{
    // Propiedades públicas para los filtros
    public $empresaId = '';
    public $searchCentro = '';
    public $searchFecha = '';

    public function render()
    {
        // Obtener la lista de empresas para el select
        $empresas = \App\Models\Empresa::all();

        // Lógica de filtrado para Móviles
        $movilesCount = Movil::query()
            ->when($this->empresaId, function($q) {
                // Si Filtramos por empresa, aseguramos que el móvil pertenezca a esa empresa
                $q->where('empresa_id', $this->empresaId);
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
            empresaId: $this->empresaId, 
            centro: $this->searchCentro
        );

        // USANDO COMPACT: Pasamos las variables a la vista
        return view('dashboard', compact('movilesCount', 'historialCount', 'empresas'))
            ->layout('components.layouts.app');
    }
}