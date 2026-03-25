<?php

namespace App\Livewire\Forms\Proveedor;

use App\Models\Proveedor;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateProveedorForm extends Form
{
    #[Validate(['required', 'string', 'min:3', 'max:200'])]
    public string $nombre = '';

    public function crearProveedorForm(){
        $this->validate();
        Proveedor::create($this->all());
    }

    public function cancelarForm(){
        $this->reset();
        $this->resetValidation('nombre');
    }
}
