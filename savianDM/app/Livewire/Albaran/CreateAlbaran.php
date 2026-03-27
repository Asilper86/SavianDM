<?php

namespace App\Livewire\Albaran;

use Livewire\Component;
use App\Models\Empresa;
use App\Models\CentroTrabajo;
use App\Models\Movil;
use App\Livewire\Forms\Albaran\CreateAlbaranForm;
use Illuminate\Support\Facades\Storage;

class CreateAlbaran extends Component
{
    public CreateAlbaranForm $form;
    
    public $openCrear = false;      
    public $showMovilModal = false; 
    public $search = '';            

    public function saveAlbaran()
    {
        // Ejecuta el guardado, relación y generación de PDF
        $albaran = $this->form->store();

        $this->openCrear = false;
        
        // Emitimos evento para que el Index se refresque si es necesario
        $this->dispatch('albaran-creado');

        session()->flash('message', 'Albarán #' . $albaran->id . ' generado con éxito.');
        
        // No descargamos aquí, dejamos que el usuario lo haga desde el Index
        return redirect()->to('/albaran');
    }

    public function addMovil($id)
    {
        if (!in_array($id, $this->form->moviles_ids)) {
            $this->form->moviles_ids[] = $id;
        }
        $this->showMovilModal = false;
        $this->search = '';
    }

    public function quitarMovil($id)
    {
        $this->form->moviles_ids = array_diff($this->form->moviles_ids, [$id]);
    }

    public function render()
    {
        return view('livewire.albaran.create-albaran', [
            'empresas' => Empresa::all(),
            'centros' => $this->form->empresa_id 
                ? CentroTrabajo::where('empresa_id', $this->form->empresa_id)->get() 
                : [],
            'search_results' => strlen($this->search) > 2 
                ? Movil::where('codigo', 'like', "%{$this->search}%")->get() 
                : [],
            'movilesSeleccionados' => Movil::whereIn('id', $this->form->moviles_ids)->get(),
        ]);
    }
}