<?php

namespace App\Livewire\Forms\Proveedor;

use App\Models\Proveedor;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateProveedorForm extends Form
{
    #[Validate(['required', 'string', 'min:3', 'max:200'])]
    public string $nombre = '';

    public ?Proveedor $proveedor = null;

    public function setProveedor(Proveedor $proveedor){
        $this->proveedor=$proveedor;
        $this->nombre=$proveedor->nombre;
    }

    public function editarProveedorForm(){
        $this->validate();
        $this->proveedor->update($this->all());
    }

    public function cancelarForm(){
        $this->reset();
        $this->resetValidation('nombre');
    }
}
