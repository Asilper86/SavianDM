<?php

namespace App\Livewire\Graficos;

use App\Models\Empresa;
use App\Models\Movil;
use Livewire\Component;

class DashboardChart extends Component
{


    public function render()
    {

        $moviles = Movil::with('empresa' , 'modelo' )->get();
        $empresas = Empresa::with(['centrosTrabajo' => function ($query) {
            $query->withCount('movils');
        }])->withCount('movils')->get();

        return view('livewire.graficos.dashboard-chart',compact('moviles' , 'empresas'));
    }
}