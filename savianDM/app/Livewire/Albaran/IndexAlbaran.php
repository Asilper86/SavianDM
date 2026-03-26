<?php

namespace App\Livewire\Albaran;

use App\Models\Albaran;
use App\Models\Empresa;
use Livewire\Component;

class IndexAlbaran extends Component
{
    public string $campo = 'id';
    public string $orden = 'desc';
    public function render()
    {
        $albaran = Albaran::orderBy($this->campo, $this->orden)->paginate(10);
        $empresas = Empresa::select('id');
        return view('livewire.albaran.index-albaran', compact('albaran', 'empresas'));
    }
}
