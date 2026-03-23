<?php

namespace App\Livewire\Forms\Movil;

use App\Models\Movil;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateMovilForm extends Form
{

    #[Validate(['required', 'min:3' , 'max:150'])]
    public string $marca = "";

    #[Validate(['required' , 'exists:modelos,id'])]
    public int $modelo_id = 0;

    #[Validate(["required"])]
    public int $codigo = 0;

    #[Validate(['required' , 'exists:empresas,id'])]
    public int $empresa_id = 0;

    #[Validate(['required' , 'exists:proveedors,id'])]
    public int $proveedor_id = 0;

    #[Validate(['required' , 'in:Propio,Alquilado'])]
    public string $tipoCompra = "";


    public function createMovilForm() {
        $datos = $this->validate();
        Movil::create($datos);
    }

    public function cancelarMovilForm() {
        $this->resetValidation();
        $this->reset();
    }
}
