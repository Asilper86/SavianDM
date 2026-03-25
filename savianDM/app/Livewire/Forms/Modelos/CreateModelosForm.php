<?php

namespace App\Livewire\Forms\Modelos;

use App\Models\Modelo;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateModelosForm extends Form
{
    #[Validate(['string', 'required', 'min:3', 'max:200'])]
    public string $nombre = '';

    public function crearModeloForm(){
        $this->validate();
        Modelo::create($this->all());
    }

    public function cancelarForm(){
        $this->reset();
        $this->resetValidation();
    }
}
