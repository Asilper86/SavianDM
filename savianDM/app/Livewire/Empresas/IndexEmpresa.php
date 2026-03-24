<?php

namespace App\Livewire\Empresas;

use App\Models\CentroTrabajo;
use App\Models\Empresa;
use Livewire\Attributes\On;
use Livewire\Component;

class IndexEmpresa extends Component
{
    #[On('evtEmpresaAnadida')]
    public function render()
    {
        $centros_trabajo = CentroTrabajo::all();
        $empresas = Empresa::select()->paginate(5);
        return view('livewire.empresas.index-empresa', compact('centros_trabajo', 'empresas'));
    }
}
