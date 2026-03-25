<?php

namespace App\Livewire\Movil;

use App\Livewire\Forms\Movil\UpdateMovilForm;
use App\Models\Empresa;
use App\Models\Modelo;
use App\Models\Movil;
use App\Models\Proveedor;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class IndexMoviles extends Component
{

     use WithPagination;

    public string $campo = "id";
    public string $orden = "desc";

    public string $buscar = "";

    public ?int $idEmpresa = null;


    public ?Movil $movil = null;


    public UpdateMovilForm $uform;

    public bool $openEditar = false;

 
    #[On('evtMovilCreado')]
    public function render()
    {
        $empresa = Empresa::select('id', 'nombre')->get();
        $modelo = Modelo::select('id','nombre')->get();
        $proveedores = Proveedor::select('id','nombre')->get();
        $moviles = Movil::with([
            'modelo',
            'proveedor',
            'empresa'
        ])
            ->where(function ($q) {
                $q->where('codigo', 'like', "%{$this->buscar}%");
            })
            ->when($this->idEmpresa, function ($q) {
                $q->where('empresa_id', $this->idEmpresa);
            })->orderBy($this->campo, $this->orden)
            ->paginate(20);
        return view('livewire.movil.index-moviles', compact('moviles', 'empresa', 'modelo' , 'proveedores'));
    }

    public function ordenar(string $campo)
    {
        $this->campo = $campo;
        $this->orden = ($this->orden == "desc") ? "asc" : "desc";
    }

    public function limpiarFiltros() {
        $this->reset(['buscar' , 'idEmpresa']);
      
    }

    public function updatedBuscar() {
        $this->resetPage();
    }

   
    // Borrar movil

    public function mostrarMensajeBorrar(Movil $movil) {
        $this->movil = $movil;
        $this->dispatch('evtBorrarMovil', destino:'movil.index-moviles');    
    }

    #[On('evtBorrarOk')]
    public function borrar() {
        $this->movil->delete();
        $this->dispatch('mensaje' , 'Movil Borrado Correctamente');
        $this->reset('movil');
    }



    //Editar Movil

    public function editar(Movil $movil) {
        $this->uform->setMovil($movil);
        $this->openEditar = true;
    }

    public function actualizarMovil() {
        $this->uform->updateMovilForm();
        $this->cancelar();
        $this->dispatch('mensaje' , 'El movil se ha actualizado correctamente');
    }

    public function cancelar() {
        $this->openEditar = false;
        $this->uform->cancelarForm();
    }
}
