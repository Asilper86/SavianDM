<?php

namespace App\Livewire\Movil;

use App\Models\Movil;
use Livewire\Component;

class IndexMoviles extends Component
{

    public string $campo = "codigo";
    public string $orden = "desc";

    public string $buscar = "";

    public function render()
    {

        $moviles = Movil::with([
            'modelo',
            'proveedor',
            'empresa.centroTrabajo',
        ])->where(function($q) {
            $q->where('codigo' , 'like' , "%{$this->buscar}%");
            }
        )->orderBy($this->campo, $this->orden)
        ->get();
        return view('livewire.movil.index-moviles' , compact('moviles'));
    }

    public function ordenar(string $campo) {
        $this->campo = $campo;
        $this->orden = ($this->orden == "desc" ) ? "asc" : "desc";
    }
}
