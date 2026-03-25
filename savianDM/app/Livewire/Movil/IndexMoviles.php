<?php

namespace App\Livewire\Movil;

use App\Models\CentroTrabajo;
use App\Models\Empresa;
use App\Models\Movil;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class IndexMoviles extends Component
{

     use WithPagination;

    public string $campo = "id";
    public string $orden = "desc";

    public string $buscar = "";

    public ?int $idEmpresa = null;

 
    #[On('evtMovilCreado')]
    public function render()
    {
        $empresa = Empresa::select('id', 'nombre')->get();
        
        $moviles = Movil::with([
            'modelo',
            'proveedor',
           
        ])
            ->where(function ($q) {
                $q->where('codigo', 'like', "%{$this->buscar}%");
            })
            ->when($this->idEmpresa, function ($q) {
                $q->where('empresa_id', $this->idEmpresa);
            })->orderBy($this->campo, $this->orden)
            ->paginate(20);
        return view('livewire.movil.index-moviles', compact('moviles', 'empresa'));
    }

    public function ordenar(string $campo)
    {
        $this->campo = $campo;
        $this->orden = ($this->orden == "desc") ? "asc" : "desc";
    }

    public function limpiarFiltros() {
        $this->reset(['buscar' , 'idEmpresa']);
      
    }
}
