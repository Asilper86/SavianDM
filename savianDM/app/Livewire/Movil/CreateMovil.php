<?php

namespace App\Livewire\Movil;

use App\Livewire\Forms\Movil\CreateMovilForm;
use App\Models\Empresa;
use App\Models\Modelo;
use App\Models\Proveedor;
use Livewire\Component;

class CreateMovil extends Component
{

    public bool $openCrear = false;

    public CreateMovilForm $cform;

    public function render()
    {
        $proveedor = Proveedor::select('id' , 'nombre')->get();
        $modelo = Modelo::select('id' , 'nombre')->get();
        $empresa = Empresa::select('id' , 'nombre')->get();
        return view('livewire.movil.create-movil' , compact('empresa' , 'modelo', 'proveedor'));
    }

    public function crearMovil() {
        $this->cform->createMovilForm();
        $this->dispatch('mensaje' , 'Movil Creado Correctamente');  
        $this->dispatch('evtMovilCreado')->to(IndexMoviles::class);
    }

    public function cancelar() {
        $this->cform->cancelarMovilForm();
        $this->openCrear = false;
    }
}
