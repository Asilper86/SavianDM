<?php

namespace App\Livewire\Proveedor;

use App\Livewire\Forms\Proveedor\CreateProveedorForm;
use Livewire\Component;

class CreateProveedor extends Component
{
    public bool $openCrear = false;
    public CreateProveedorForm $cform;
    public function render()
    {
        return view('livewire.proveedor.create-proveedor');
    }



    public function crearProveedor(){
        $this->cform->crearProveedorForm();
        $this->cancelar();
        $this->dispatch('evtProveedorCreate')->to(IndexProveedor::class);
        $this->dispatch('mensaje', 'Proveedor Añadido');
    }

    public function cancelar(){
        $this->cform->cancelarForm();
        $this->openCrear=false;
    }
}
