<?php

namespace App\Livewire\Movil;

use App\Livewire\Forms\Movil\CreateMovilForm;
use App\Models\Empresa;
use Livewire\Component;

class CreateMovil extends Component
{

    public bool $openCrear = false;

    public CreateMovilForm $cform;

    public function render()
    {
        $empresa = Empresa::select('id' , 'nombre')->get();
        return view('livewire.movil.create-movil' , compact('empresa'));
    }

    public function crearMovil() {
        $this->cform->createMovilForm();
    }

    public function cancelar() {
        $this->cform->cancelarMovilForm();
        $this->openCrear = false;
    }
}
