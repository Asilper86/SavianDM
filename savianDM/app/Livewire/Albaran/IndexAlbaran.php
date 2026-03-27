<?php

namespace App\Livewire\Albaran;

use App\Models\Albaran;
use App\Models\Empresa;
use Illuminate\Support\Facades\Storage;
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

    public function descargarPDF(int $id){
        $albaran = Albaran::findOrFail($id);

        if (!Storage::disk('public')->exists(str_replace('storage/', '', $albaran->path))) {
            session()->flash('error', 'El archivo no se encuentra en el servidor.');
            return;
        }
    
        return Storage::disk('public')->download(str_replace('storage/', '', $albaran->path));
    }
}
