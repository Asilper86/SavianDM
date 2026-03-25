<?php

namespace App\Livewire\Forms\Modelos;

use App\Models\Modelo;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateModelosForm extends Form
{
    #[Validate(['string', 'required', 'min:3', 'max:200'])]
    public string $nombre = '';
    public ?Modelo $modelo = null;



    public function setModelo(Modelo $modelo){
        $this->modelo=$modelo;
        $this->nombre=$modelo->nombre;
    }

    public function editarModeloForm(){
        $this->validate();
        $this->modelo->update($this->all());
    }

    public function cancelarForm(){
        $this->reset();
        $this->resetValidation();
    }
}
