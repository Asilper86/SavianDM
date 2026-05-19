<?php

namespace App\Livewire\Material;

use App\Livewire\Forms\Material\CreateMaterialForm;
use Livewire\Component;

class CreateMaterial extends Component
{
    public bool $openCrear = false;

    public CreateMaterialForm $cform;

    public function render()
    {
        return view('livewire.material.create-material');
    }

    public function crearMaterial() {
        $this->cform->createMaterialForm();
        $this->dispatch('mensaje', 'Material Creado Correctamente');  
        $this->dispatch('evtMaterialCreado')->to(IndexMateriales::class);
        $this->openCrear = false;
    }

    public function cancelar() {
        $this->cform->cancelarMaterialForm();
        $this->openCrear = false;
    }
}
