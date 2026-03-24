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


    public function createForm(){
        $this->validate();
        Empresa::create($this->all());
    }

    public function cancelarForm(){
        $this->reset('nombre', 'hectarea');
        $this->resetValidation();
    }

    

}
