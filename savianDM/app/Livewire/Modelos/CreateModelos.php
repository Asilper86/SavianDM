<?php

namespace App\Livewire\Modelos;

use App\Livewire\Forms\Modelos\CreateModelosForm;
use App\Models\Modelo;
use Livewire\Component;

class CreateModelos extends Component
{
    public bool $openCrear = false;
    public CreateModelosForm $cform;
    public ?Modelo $modelo = null;
    public function render()
    {
        return view('livewire.modelos.create-modelos');
    }


    public function guardar(){
        $this->cform->crearModeloForm();
        $this->cancelar();
        $this->dispatch('evtModeloCreado')->to(IndexModelos::class);
        $this->dispatch('mensaje', 'Modelo Creado');
    }

    public function cancelar(){
        $this->cform->cancelarForm();
        $this->openCrear=false;
    }

}
