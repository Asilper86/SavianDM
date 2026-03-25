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

    public function lanzarAlerta(Empresa $empresa)
    {
        $this->empresa = $empresa;
        $this->dispatch('evtEmpresaBorrado', destino: 'empresas.index-empresa');
    }

    #[On('evtBorrarOk')]
    public function borrar()
    {
        if ($this->empresa) {
        
            // 2. ARREGLO DE INTEGRIDAD: Borramos los móviles vinculados primero
            // Esto elimina el conflicto con la FK "movils_centro_trabajo_id_foreign"
            $this->empresa->movils()->delete(); 
    
            // 3. Ahora la empresa está "libre" y se puede borrar sin errores de SQL
            $this->empresa->delete();
    
            $this->dispatch('mensaje', 'Empresa y sus móviles eliminados');
            
            // Limpiamos la propiedad para la siguiente acción
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
}
