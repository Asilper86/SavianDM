<?php

namespace App\Livewire\Empresas;

use App\Livewire\Forms\Empresas\UpdateEmpresasForm;
use App\Models\Empresa;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class IndexEmpresa extends Component
{
    use WithPagination;

    public string $orden = 'desc';

    public string $campo = 'id';

    public ?Empresa $empresa = null;

    public bool $openEditar = false;

    public UpdateEmpresasForm $uform;

    #[On('evtEmpresaAnadida')]
    public function render()
    {
        $empresas = Empresa::orderBy($this->campo, $this->orden)->paginate(4);

        return view('livewire.empresas.index-empresa', compact('empresas'));
    }

    public function ordenar(string $campo)
    {
        $this->orden = ($this->orden == 'asc') ? 'desc' : 'asc';
        $this->campo = $campo;
    }

    public function borrar($id)
    {
        $empresa = Empresa::find($id);
        $empresa->movils()->delete();
        $empresa->delete();
        $this->dispatch('mensaje', 'Empresa Eliminada');
    }

    public function update(Empresa $empresa){
        $this->uform->setEmpresa($empresa);
        $this->openEditar = true;
    }

    public function editar(){
        $this->uform->editarForm();
        $this->cancelar();
        $this->dispatch('mensaje', 'Empresa Actualizada');
    }

    public function cancelar(){
        $this->uform->cancelarForm();
        $this->openEditar=false;
    }
}
