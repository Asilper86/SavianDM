<?php

namespace App\Livewire\Modelos;

use App\Livewire\Forms\Modelos\UpdateModelosForm;
use App\Models\Modelo;
use Livewire\Attributes\On;
use Livewire\Component;

class IndexModelos extends Component
{
    public string $campo = 'id';
    public string $orden = 'desc';
    public ?Modelo $modelo = null;
    public UpdateModelosForm $uform;
    public bool $openEditar=false;

    #[On('evtModeloCreado')]
    public function render()
    {
        $modelos = Modelo::orderBy($this->campo, $this->orden)->paginate(4);
        return view('livewire.modelos.index-modelos', compact('modelos'));
    }

    public function ordenar(string $campo){
        $this->orden=($this->orden == 'desc') ? 'asc' : 'desc';
        $this->campo=$campo;
    }


    public function lanzarAlerta(Modelo $modelo){
        $this->modelo=$modelo;
        $this->dispatch('evtModeloBorrado', destino: 'modelos.index-modelos');
    }

    #[On('evtBorrarOk')]
    public function borrar(){
        $this->modelo->delete();
        $this->dispatch('mensaje', 'Modelo Eliminado');
    }

    public function update(Modelo $modelo){
        $this->uform->setModelo($modelo);
        $this->openEditar=true;
    }

    public function edit(){
        $this->uform->editarModeloForm();
        $this->cancelar();
        $this->dispatch('mensaje', 'Modelo Actualizado.');
    }

    public function cancelar(){
        $this->uform->cancelarForm();
        $this->openEditar=false;
    }
}
