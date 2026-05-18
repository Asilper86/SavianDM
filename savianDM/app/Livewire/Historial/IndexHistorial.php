<?php

namespace App\Livewire\Historial;

use App\Models\Historial;
use Livewire\Component;
use Livewire\WithPagination;

class IndexHistorial extends Component
{
    use WithPagination;

    public string $buscar = '';
    public string $estados = '';
    
    public function render()
    {
        $historial = Historial::with(['movil.modelo', 'empresa', 'albaran'])
            ->where(function ($q) {
                $q->whereHas('movil', function ($mq) {
                    $mq->where('codigo', 'like', "%{$this->buscar}%");
                })->orWhere('descripcion', 'like', "%{$this->buscar}%");
            })
            ->when($this->estados, function ($q) {
                $q->where('estado', $this->estados);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('livewire.historial.index-historial', compact('historial'));
    }

    public function descargarPDF(int $id)
    {
        $albaran = \App\Models\Albaran::findOrFail($id);

        if (! \Illuminate\Support\Facades\Storage::disk('public')->exists(str_replace('storage/', '', $albaran->path))) {
            session()->flash('error', 'El archivo no se encuentra en el servidor.');
            return;
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->download(str_replace('storage/', '', $albaran->path));
    }

    public function limpiarFiltros()
    {
        $this->reset(['buscar', 'estados']);
    }
}
