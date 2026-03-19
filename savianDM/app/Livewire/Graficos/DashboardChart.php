<?php
namespace App\Livewire\Graficos;

use Livewire\Component;
use App\Models\Empresa;
use App\Models\CentroTrabajo;

class DashboardChart extends Component
{
    public $empresaId = '';

    public function render()
    {
        $empresas = Empresa::all();

        // Obtenemos centros filtrados por empresa y contamos sus móviles
        $centros = CentroTrabajo::query()
            ->when($this->empresaId, fn($q) => $q->where('empresa_id', $this->empresaId))
            ->withCount('movils')
            ->get()
            ->where('movils_count', '>', 0); // Solo centros con móviles

        $labels = $centros->pluck('nombre');
        $valores = $centros->pluck('movils_count');

        // Notificamos al JS que los datos cambiaron
        $this->dispatch('chartUpdated', labels: $labels, values: $valores);

        return view('livewire.graficos.dashboard-chart', [
            'empresas' => $empresas,
            'labels' => $labels,
            'valores' => $valores,
        ]);
    }
}