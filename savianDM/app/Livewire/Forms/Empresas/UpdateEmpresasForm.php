<?php

namespace App\Livewire\Forms\Empresas;

use App\Models\Empresa;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateEmpresasForm extends Form
{
    #[Validate(['required', 'string', 'min:4', 'max:200'])]
    public string $nombre = '';
    #[Validate(['numeric', 'min:0'])]
    public ?float $hectarea = 0.0;

    public ?Empresa $empresa = null;



    public function setEmpresa(Empresa $empresa){
        $this->empresa=$empresa;
        $this->nombre=$empresa->nombre;
        $this->hectarea=$empresa->hectarea;
    }

    public function editarForm(){
        $this->validate();
        $this->empresa->update($this->all());
    }

    public function cancelarForm(){
        $this->reset('nombre', 'hectarea');
        $this->resetValidation();
    }
}
