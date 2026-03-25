<?php

namespace App\Livewire\Forms\Movil;

use App\Models\Movil;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateMovilForm extends Form
{

    public ?Movil $movil = null;
    
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


    public function setMovil(Movil $movil) {
        $this->movil = $movil;
        $this->codigo = $movil->codigo;
        $this->estado = $movil->estado;
        $this->proveedor_id = $movil->proveedor_id;
        $this->modelo_id = $movil->modelo_id;
        $this->empresa_id = $movil->empresa_id;
        $this->tipoCompra = $movil->tipoCompra;
    }

    public function updateMovilForm() {
        $datos = $this->validate();
        $this->movil->update($datos);
    }

    public function cancelarForm() {
        $this->resetValidation();
        $this->reset();
    }
}
