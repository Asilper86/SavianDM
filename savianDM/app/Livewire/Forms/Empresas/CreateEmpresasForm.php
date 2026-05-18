<?php

namespace App\Livewire\Forms\Empresas;

use App\Models\Empresa;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateEmpresasForm extends Form
{
    #[Validate(['required', 'string', 'min:4', 'max:200'])]
    public string $nombre = '';
    #[Validate(['numeric', 'min:0'])]
    public float $hectarea = 0.0;


    public array $centros_trabajo = [''];

    public function createForm(){
        $this->validate();
        
        $empresa = Empresa::create([
            'nombre' => $this->nombre,
            'hectarea' => $this->hectarea,
        ]);
        
        foreach($this->centros_trabajo as $centro) {
            if(!empty(trim($centro))) {
                $empresa->centrosTrabajo()->create(['nombre' => trim($centro)]);
            }
        }
    }

    public function cancelarForm(){
        $this->reset('nombre', 'hectarea');
        $this->centros_trabajo = [''];
        $this->resetValidation();
    }

    

}
