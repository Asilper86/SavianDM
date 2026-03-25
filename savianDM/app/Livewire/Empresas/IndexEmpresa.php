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

    public string $buscar = '';

    public UpdateEmpresasForm $uform;

    #[On('evtEmpresaAnadida')]
    public function render()
    {
        $empresas = Empresa::where('nombre', 'like', '%'. $this->buscar . '%')
            ->orderBy($this->campo, $this->orden)
            ->paginate(4);

        return view('livewire.empresas.index-empresa', compact('empresas'));
    }

    public function ordenar(string $campo)
    {
        $this->orden = ($this->orden == 'asc') ? 'desc' : 'asc';
        $this->campo = $campo;
    }

    public function lanzarAlerta(Empresa $empresa)
    {
        $this->empresa = $empresa;
        $this->dispatch('evtEmpresaBorrado', destino: 'empresas.index-empresa');
    }

    #[On('evtBorrarOk')]
    public function borrar()
    {
        if ($this->empresa) {
            $this->empresa->movils()->delete();
            $this->dispatch('mensaje', 'Empresa y sus móviles eliminados');
            $this->empresa = null;
        }
    }

    public function update(Empresa $empresa)
    {
        $this->uform->setEmpresa($empresa);
        $this->openEditar = true;
    }

    public function editar()
    {
        $this->uform->editarForm();
        $this->cancelar();
        $this->dispatch('mensaje', 'Empresa Actualizada');
    }

    public function cancelar()
    {
        $this->uform->cancelarForm();
        $this->openEditar = false;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
