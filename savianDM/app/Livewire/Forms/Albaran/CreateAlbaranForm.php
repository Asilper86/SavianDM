<?php

namespace App\Livewire\Forms\Albaran;

use App\Models\Albaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateAlbaranForm extends Form
{
    #[Validate('required|exists:empresas,id', as: 'empresa')]
    public int $empresa_id = 0;

    #[Validate('required|exists:centro_trabajos,id', as: 'centro de trabajo')]
    public int $centro_trabajo_id = 0;

    #[Validate('required|in:pendiente,entregado,retirado')]
    public string $estado = 'pendiente';

    #[Validate('required|array|min:1', as: 'móviles')]
    public array $moviles_ids = [];

    public bool $fundas = false;

    public function store()
    {
        $this->validate();

        return DB::transaction(function () {
            $albaran = Albaran::create([
                'empresa_id' => $this->empresa_id,
                'centro_trabajo_id' => $this->centro_trabajo_id,
                'estado' => $this->estado,
                'path' => '',

            ]);

            $albaran->moviles()->attach($this->moviles_ids);
            $albaran->load(['empresas', 'centrosTrabajos', 'moviles.modelo']);

            $pdfContent = Pdf::loadView('pdf.albaran-template', [
                'albaran' => $albaran,
                'fundas' => $this->fundas,
            ])->output();

            $fileName = 'albaran_'.$albaran->id.'_'.time().'.pdf';
            $filePath = 'albarans/'.$fileName;
            Storage::disk('public')->put($filePath, $pdfContent);

            $albaran->update(['path' => 'storage/'.$filePath]);
            $this->reset();

            return $albaran;
        });
    }
}
