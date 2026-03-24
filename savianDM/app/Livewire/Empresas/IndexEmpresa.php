<?php

namespace App\Livewire\Empresas;

use App\Models\CentroTrabajo;
use App\Models\Empresa;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class IndexEmpresa extends Component
{
    use WithPagination;
    public string $orden = 'desc';
    public string $campo = 'id';
    public ?Empresa $empresa=null;

    #[On('evtEmpresaAnadida')]
    public function render()
    {
        $empresas = Empresa::orderBy($this->campo, $this->orden)->paginate(4);
        return view('livewire.empresas.index-empresa', compact( 'empresas'));
    }

    public function ordenar(string $campo){
        $this->orden=($this->orden=='asc') ? 'desc' : 'asc';
        $this->campo=$campo;
    }

    public function borrar(){
        $this->empresa->delete();  
    }
}
