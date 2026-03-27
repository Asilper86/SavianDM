<?php

namespace App\Livewire\Albaran;

use Livewire\Component;
use App\Models\Albaran;
use App\Models\Empresa;
use App\Models\CentroTrabajo;
use App\Models\Movil;
use App\Livewire\Forms\Albaran\CreateAlbaranForm;
use App\Livewire\Forms\Albaran\UpdateAlbaranForm;
use Livewire\Attributes\On;

class CreateAlbaran extends Component
{
    public CreateAlbaranForm $createForm;
    public UpdateAlbaranForm $updateForm;
    
    public $isEditing = false;
    public $openCrear = false;
    public $showMovilModal = false;
    public $search = '';

    // Escuchamos el evento desde el Index
    #[On('editar-albaran')]
    public function loadAlbaran($id)
    {
        $this->isEditing = true;
        $albaran = Albaran::with('moviles')->findOrFail($id);
        
        // Cargamos los datos en el formulario de UPDATE
        $this->updateForm->setAlbaran($albaran);
        $this->openCrear = true;
    }

    public function save()
    {
        if ($this->isEditing) {
            $this->updateForm->update();
            session()->flash('message', 'Albarán actualizado con éxito.');
        } else {
            $this->createForm->store();
            session()->flash('message', 'Albarán creado con éxito.');
        }

        $this->reset(['openCrear', 'isEditing']);
        return redirect()->to('/albaran');
    }

    // Proxy para manejar los móviles según el modo
    public function addMovil($id)
    {
        if ($this->isEditing) {
            if (!in_array($id, $this->updateForm->moviles_ids)) $this->updateForm->moviles_ids[] = $id;
        } else {
            if (!in_array($id, $this->createForm->moviles_ids)) $this->createForm->moviles_ids[] = $id;
        }
        $this->showMovilModal = false;
        $this->search = '';
    }

    // Esta es la función que te pide el error
    public function abrirModalCrear()
    {
        $this->isEditing = false;
        $this->createForm->reset(); // Limpiamos el formulario de creación
        $this->openCrear = true;
    }

    // Y esta es recomendable para cerrar y limpiar
    public function cerrarModal()
    {
        $this->openCrear = false;
        $this->isEditing = false;
        $this->createForm->reset();
        $this->updateForm->reset();
    }
    
    // También te falta el método para quitar móviles de la lista
    public function quitarMovil($id)
    {
        if ($this->isEditing) {
            $this->updateForm->moviles_ids = array_diff($this->updateForm->moviles_ids, [$id]);
        } else {
            $this->createForm->moviles_ids = array_diff($this->createForm->moviles_ids, [$id]);
        }
    }

    public function render()
    {
        // Determinamos qué IDs de móviles mostrar en la lista
        $currentIds = $this->isEditing ? $this->updateForm->moviles_ids : $this->createForm->moviles_ids;
        $empresaId = $this->isEditing ? $this->updateForm->empresa_id : $this->createForm->empresa_id;

        return view('livewire.albaran.create-albaran', [
            'empresas' => Empresa::all(),
            'centros' => $empresaId ? CentroTrabajo::where('empresa_id', $empresaId)->get() : [],
            'search_results' => strlen($this->search) > 2 ? Movil::where('codigo', 'like', "%{$this->search}%")->get() : [],
            'movilesSeleccionados' => Movil::whereIn('id', $currentIds)->get(),
        ]);
    }
}