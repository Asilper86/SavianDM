<?php

namespace App\Livewire\Forms\Albaran;

use App\Models\Albaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Barryvdh\DomPDF\Facade\Pdf;

class UpdateAlbaranForm extends Form
{
    public ?Albaran $albaranModel;

    #[Validate('required|exists:empresas,id')]
    public $empresa_id;

    #[Validate('required|exists:centro_trabajos,id')]
    public $centro_trabajo_id;

    #[Validate('required|in:pendiente,entregado,retirado')]
    public $estado;

    #[Validate(['required', 'array', 'min:1'])]
    public $moviles_ids = [];

    // Cargar los datos del albarán existente al formulario
    public function setAlbaran(Albaran $albaran)
    {
        $this->albaranModel = $albaran;
        $this->empresa_id = $albaran->empresa_id;
        $this->centro_trabajo_id = $albaran->centro_trabajo_id;
        $this->estado = $albaran->estado;
        $this->moviles_ids = $albaran->moviles->pluck('id')->toArray();
    }

    public function update()
    {
        $this->validate();

        return DB::transaction(function () {
            // 1. Actualizar datos en la DB
            $this->albaranModel->update([
                'empresa_id' => $this->empresa_id,
                'centro_trabajo_id' => $this->centro_trabajo_id,
                'estado' => $this->estado,
            ]);

            $this->albaranModel->moviles()->sync($this->moviles_ids);

            // 2. REGENERAR EL PDF
            // Cargamos las relaciones frescas para que el PDF tenga los nombres nuevos
            $this->albaranModel->load(['empresas', 'centrosTrabajos', 'moviles.modelo']);

            $pdf = Pdf::loadView('pdf.albaran-template', [
                'albaran' => $this->albaranModel,
                'fundas' => $this->albaranModel->fundas, // O la lógica que uses para fundas
            ]);

            // 3. Sobrescribir el archivo en el Storage
            // Usamos el path que ya tiene guardado el modelo
            $path = str_replace('storage/', '', $this->albaranModel->path);
            Storage::disk('public')->put($path, $pdf->output());

            return $this->albaranModel;
        });
    }
}
