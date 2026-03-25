<?php

namespace App\Livewire\Modelos;

use App\Models\Modelo;
use Livewire\Component;

class IndexModelos extends Component
{
    public string $campo = 'id';
    public string $orden = 'desc';
    public function render()
    {
        $modelos = Modelo::orderBy($this->campo, $this->orden)->paginate(4);
        return view('livewire.modelos.index-modelos', compact('modelos'));
    }
}
