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

    #[Validate('required|in:incidencia,visita')]
    public $tipo_trabajo;

    #[Validate('required|string|min:5')]
    public $descripcion;

    #[Validate(['required', 'array', 'min:1'])]
    public $moviles_ids = [];

    #[Validate('nullable|string')]
    public $lugar;

    #[Validate('required|date')]
    public $fecha;

    #[Validate([
        'trabajadores' => 'nullable|array',
        'trabajadores.*.nombre' => 'required|string|min:2',
        'trabajadores.*.entrada' => 'required',
        'trabajadores.*.salida' => 'required',
    ])]
    public array $trabajadores = [];

    public $firma_trabajador;
    public $firma_cliente;

    public function addTrabajador()
    {
        $this->trabajadores[] = ['nombre' => '', 'entrada' => '', 'salida' => ''];
    }

    public function removeTrabajador($index)
    {
        unset($this->trabajadores[$index]);
        $this->trabajadores = array_values($this->trabajadores);
    }
    #[Validate('required|string|min:2|max:100')]
    public string $nombre_firmante = '';

    // Cargar los datos del albarán existente al formulario
    public function setAlbaran(Albaran $albaran)
    {
        $this->albaranModel = $albaran;
        $this->empresa_id = $albaran->empresa_id;
        $this->centro_trabajo_id = $albaran->centro_trabajo_id;
        $this->estado = $albaran->estado;
        $this->tipo_trabajo = $albaran->tipo_trabajo;
        $this->descripcion = $albaran->descripcion;
        $this->lugar = $albaran->lugar;
        $this->fecha = $albaran->fecha;
        $this->trabajadores = $albaran->trabajadores_datos ?? [];
        $this->firma_trabajador = $albaran->firma_trabajador;
        $this->firma_cliente = $albaran->firma_cliente;
        $this->moviles_ids = $albaran->moviles->pluck('id')->toArray();
        $this->nombre_firmante = $albaran->nombre_firmante;
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
                'lugar' => $this->lugar,
                'fecha' => $this->fecha,
                'nombre_firmante' => $this->nombre_firmante,
                'trabajadores_datos' => $this->trabajadores,
                'tipo_trabajo' => $this->tipo_trabajo,
                'descripcion' => $this->descripcion,
                'firma_trabajador' => $this->firma_trabajador,
                'firma_cliente' => $this->firma_cliente,
            ]);

            $this->albaranModel->moviles()->sync($this->moviles_ids);

            // 2. REGENERAR EL PDF
            // Cargamos las relaciones frescas para que el PDF tenga los nombres nuevos
            $this->albaranModel->load(['empresas', 'centrosTrabajos', 'moviles.modelo']);

            ini_set('memory_limit', '512M');
            ini_set('max_execution_time', '300');

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
