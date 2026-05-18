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

    public string $codigo = "";

    #[Validate(['required' , 'exists:empresas,id'])]
    public int $empresa_id = 0;

    #[Validate(['required' , 'exists:proveedors,id'])]
    public int $proveedor_id = 0;

    #[Validate(['required' , 'in:Propio,Alquilado'])]
    public string $tipoCompra = "";



    public function rules(): array {
        return [
            'codigo' => ['required' , 'string' , 'min:3' , 'unique:movils,codigo,'.$this->movil->id],
        ];
    }


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
        $oldEstado = $this->movil->estado;
        $oldEmpresaId = $this->movil->empresa_id;

        $this->movil->update($datos);

        if ($oldEstado !== $this->movil->estado || $oldEmpresaId !== $this->movil->empresa_id) {
            \App\Models\Historial::create([
                'movil_id' => $this->movil->id,
                'estado' => $this->movil->estado,
                'empresa_id' => $this->movil->empresa_id,
                'descripcion' => 'Actualización manual de estado/empresa',
            ]);
        }
    }

    public function cancelarForm() {
        $this->resetValidation();
        $this->reset();
    }
}
