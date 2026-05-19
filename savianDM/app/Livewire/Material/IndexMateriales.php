<?php

namespace App\Livewire\Material;

use App\Livewire\Forms\Material\UpdateMaterialForm;
use App\Models\Material;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class IndexMateriales extends Component
{
    use WithPagination;

    public string $campo = "id";
    public string $orden = "desc";
    public string $buscar = "";

    public ?Material $material = null;
    public UpdateMaterialForm $uform;
    public bool $openEditar = false;

    #[On('evtMaterialCreado')]
    public function render()
    {
        $materiales = Material::where('nombre', 'like', "%{$this->buscar}%")
            ->orderBy($this->campo, $this->orden)
            ->paginate(20);

        return view('livewire.material.index-materiales', compact('materiales'));
    }

    public function ordenar(string $campo)
    {
        $this->campo = $campo;
        $this->orden = ($this->orden == "desc") ? "asc" : "desc";
    }

    public function limpiarFiltros()
    {
        $this->reset(['buscar']);
    }

    public function updatedBuscar()
    {
        $this->resetPage();
    }

    // Borrar material
    public function mostrarMensajeBorrar(Material $material)
    {
        $this->material = $material;
        $this->dispatch('evtBorrarMaterial', destino: 'material.index-materiales');
    }

    #[On('evtBorrarOk')]
    public function borrar()
    {
        if ($this->material) {
            $this->material->delete();
            $this->dispatch('mensaje', 'Material Borrado Correctamente');
            $this->reset('material');
        }
    }

    // Editar Material
    public function editar(Material $material)
    {
        $this->uform->setMaterial($material);
        $this->openEditar = true;
    }

    public function actualizarMaterial()
    {
        $this->uform->updateMaterialForm();
        $this->cancelar();
        $this->dispatch('mensaje', 'El material se ha actualizado correctamente');
    }

    public function cancelar()
    {
        $this->openEditar = false;
        $this->uform->cancelarForm();
    }
}
