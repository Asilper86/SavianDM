<?php

namespace App\Livewire\Forms\Albaran;

use Livewire\Form;
use App\Models\Albaran;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;

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
            // Actualizar datos básicos
            $this->albaranModel->update([
                'empresa_id' => $this->empresa_id,
                'centro_trabajo_id' => $this->centro_trabajo_id,
                'estado' => $this->estado,
            ]);

            // Sincronizar tabla intermedia dbo.albaran_movil (borra lo viejo, mete lo nuevo)
            $this->albaranModel->moviles()->sync($this->moviles_ids);

            return $this->albaranModel;
        });
    }
}