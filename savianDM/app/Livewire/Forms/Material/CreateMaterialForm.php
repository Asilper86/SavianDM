<?php

namespace App\Livewire\Forms\Material;

use App\Models\Material;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateMaterialForm extends Form
{
    #[Validate(['required', 'string', 'min:3'])]
    public string $nombre = "";

    #[Validate(['required', 'integer', 'min:0'])]
    public int $cantidad = 0;

    #[Validate(['nullable', 'string'])]
    public ?string $descripcion = "";

    public function createMaterialForm() {
        $datos = $this->validate();
        Material::create($datos);
        $this->reset();
    }

    public function cancelarMaterialForm() {
        $this->resetValidation();
        $this->reset();
    }
}
