<?php

namespace App\Livewire\Movil;

use App\Models\Movil;
use Livewire\Component;

class IndexMoviles extends Component
{
    public function render()
    {
        $moviles = Movil::with([
            'modelo',
            'proveedor',
            'empresa.centroTrabajo',
        ])->get();
        return view('livewire.movil.index-moviles');
    }
}
