<?php

namespace App\Livewire\Proveedor;

use App\Livewire\Forms\Proveedor\UpdateProveedorForm;
use App\Models\Proveedor;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class IndexProveedor extends Component
{
    use WithPagination;

    public string $campo = 'id';
    public string $orden = 'desc';
    public UpdateProveedorForm $uform;
    public bool $openEditar = false;
    public ?Proveedor $proveedors=null;
    public string $buscar = '';

    #[On('evtProveedorCreate')]
    public function render()
    {
        $proveedor = Proveedor::where('nombre', 'like', '%'.$this->buscar.'%')
            ->orderBy($this->campo, $this->orden)->paginate(4);
        return view('livewire.proveedor.index-proveedor', compact('proveedor'));
    }

    public function ordenar(?string $campo=null){
        $this->orden=($this->orden == 'desc') ? 'asc' : 'desc';
        $this->campo=$campo;
    }

    public function lanzarAlerta(Proveedor $proveedor){
        $this->proveedors=$proveedor;
        $this->dispatch('evtProveedorBorrado', destino: 'proveedor.index-proveedor');
    }
    
    #[On('evtBorrarOk')]
    public function borrar(){
        $this->proveedors->delete();
        $this->dispatch('mensaje', 'Proveedor Eliminado');
    }

    public function update(Proveedor $proveedor){
        $this->uform->setProveedor($proveedor);
        $this->openEditar=true;
    }

    public function editar(){
        $this->uform->editarProveedorForm();
        $this->cancelar();
        $this->dispatch('mensaje', 'Proveedor Actualizo');
    }

    public function cancelar(){
        $this->uform->cancelarForm();
        $this->openEditar=false;
    }
}
