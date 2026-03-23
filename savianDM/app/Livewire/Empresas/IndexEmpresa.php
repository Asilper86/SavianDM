<?php

namespace App\Livewire\Empresas;

use App\Models\CentroTrabajo;
use App\Models\Empresa;
use Livewire\Component;

class IndexEmpresa extends Component
{
    public function render()
    {
        $centros_trabajo = CentroTrabajo::all();
        $empresas = Empresa::select()->paginate(3);
        return view('livewire.empresas.index-empresa', compact('centros_trabajo', 'empresas'));
    }
}
