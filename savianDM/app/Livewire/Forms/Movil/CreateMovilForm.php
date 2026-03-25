<?php

namespace App\Livewire\Forms\Movil;

use App\Models\Movil;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateMovilForm extends Form
{

    #[Validate(['required', 'in:Stock,Roto,Campo,Preparado'])]
    public string $estado = "";

    #[Validate(['required' , 'exists:modelos,id'])]
    public int $modelo_id = 0;

    #[Validate(["required" , 'min:3'])]
    public string $codigo = "";

    #[Validate(['required' , 'exists:empresas,id'])]
    public int $empresa_id = 0;

    #[Validate(['required' , 'exists:proveedors,id'])]
    public int $proveedor_id = 0;

    #[Validate(['required' , 'in:Propio,Alquilado'])]
    public string $tipoCompra = "";


    public function createMovilForm() {
        $datos = $this->validate();
        Movil::create($datos);
        $this->reset('codigo');
    }

    public function cancelarMovilForm() {
        $this->resetValidation();
        $this->reset();
    }
}
