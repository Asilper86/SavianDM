<?php

namespace App\Livewire\Movil;

use App\Models\CentroTrabajo;
use App\Models\Empresa;
use App\Models\Movil;
use Livewire\Component;

class IndexMoviles extends Component
{

    public string $campo = "codigo";
    public string $orden = "desc";

    public string $buscar = "";

    public ?int $idEmpresa = null;

    public ?int $idCentro = null;

    public function render()
    {
        $empresa = Empresa::select('id' , 'nombre')->get();
        $centroTrabajo = CentroTrabajo::select('id', 'nombre')
        ->when($this->idEmpresa, function ($query) {
        $query->where('empresa_id', $this->idEmpresa);
        })->get();
       $moviles = Movil::with([
        'modelo',
        'proveedor',
        'empresa.centroTrabajo',
    ])
    ->where(function ($q) {
        $q->where('codigo', 'like', "%{$this->buscar}%");
    })
    ->when($this->idEmpresa, function ($q) {
        $q->where('empresa_id', $this->idEmpresa);
    })
    ->when($this->idCentro, function ($q) {
        $q->whereHas('empresa.centroTrabajo', function ($q2) {
            $q2->where('id', $this->idCentro);
        });
    })

    ->orderBy($this->campo, $this->orden)
    ->get();
        return view('livewire.movil.index-moviles' , compact('moviles' , 'empresa' , 'centroTrabajo') );
    }

    public function ordenar(string $campo) {
        $this->campo = $campo;
        $this->orden = ($this->orden == "desc" ) ? "asc" : "desc";
    }
}
