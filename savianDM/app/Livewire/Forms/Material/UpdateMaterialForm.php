<?php

namespace App\Livewire\Forms\Material;

use App\Models\Material;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateMaterialForm extends Form
{
    public ?Material $material = null;
    
    #[Validate(['required', 'string', 'min:3'])]
    public string $nombre = "";

    #[Validate(['required', 'integer', 'min:0'])]
    public int $cantidad = 0;

    #[Validate(['nullable', 'string'])]
    public ?string $descripcion = "";

    public function setMaterial(Material $material) {
        $this->material = $material;
        $this->nombre = $material->nombre;
        $this->cantidad = $material->cantidad;
        $this->descripcion = $material->descripcion;
    }

    public function updateMaterialForm() {
        $datos = $this->validate();
        $this->material->update($datos);
    }

    public function cancelarForm() {
        $this->resetValidation();
        $this->reset();
    }
}
