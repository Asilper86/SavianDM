<?php

namespace App\Livewire\Empresas;

use App\Livewire\Forms\Empresas\CreateEmpresasForm;
use Livewire\Component;

class CreateEmpresas extends Component
{

    public bool $openCrear = false;
    public CreateEmpresasForm $cform;
    public function render()
    {
        return view('livewire.empresas.create-empresas');
    }

    public function crearEmpresa(){
        $this->cform->createForm();
        $this->cancelar();
    }

    public function cancelar(){
        $this->cform->cancelarForm();
        $this->openCrear=false;
    }
}
