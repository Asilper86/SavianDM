<?php

namespace App\Livewire\Forms\Albaran;

use App\Models\Albaran;
use App\Models\Movil;
use App\Models\Material;
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

    #[Validate('required|in:incidencia,visita')]
    public string $tipo_trabajo = 'incidencia';

    #[Validate('required|string|min:5')]
    public string $descripcion = '';

    #[Validate('required|array|min:1', as: 'móviles')]
    public array $moviles_ids = [];

    #[Validate('nullable|string')]
    public string $lugar = '';

    #[Validate('required|date')]
    public string $fecha = '';

    public bool $fundas = false;
    #[Validate('required|string|min:2|max:100')]
    public string $nombre_firmante = '';

    #[Validate([
        'trabajadores' => 'nullable|array',
        'trabajadores.*.nombre' => 'required|string|min:2',
        'trabajadores.*.entrada' => 'required',
        'trabajadores.*.salida' => 'required',
    ])]
    public array $trabajadores = [];

    #[Validate([
        'materiales' => 'nullable|array',
        'materiales.*.material_id' => 'nullable|exists:materiales,id',
        'materiales.*.material_ocasional' => 'nullable|string|max:255',
        'materiales.*.cantidad' => 'required|integer|min:1',
    ])]
    public array $materiales = [];

    public string $firma_trabajador = '';
    public string $firma_cliente = '';

    public function addTrabajador()
    {
        $this->trabajadores[] = ['nombre' => '', 'entrada' => '', 'salida' => ''];
    }

    public function removeTrabajador($index)
    {
        unset($this->trabajadores[$index]);
        $this->trabajadores = array_values($this->trabajadores);
    }

    public function addMaterial()
    {
        $this->materiales[] = ['material_id' => '', 'material_ocasional' => '', 'cantidad' => 1];
    }

    public function removeMaterial($index)
    {
        unset($this->materiales[$index]);
        $this->materiales = array_values($this->materiales);
    }

    public function store()
    {
        $this->validate();

        return DB::transaction(function () {
            $albaran = Albaran::create([
                'empresa_id' => $this->empresa_id,
                'centro_trabajo_id' => $this->centro_trabajo_id,
                'estado' => $this->estado,
                'lugar' => $this->lugar,
                'fecha' => $this->fecha,
                'nombre_firmante'=> $this->nombre_firmante,
                'trabajadores_datos' => $this->trabajadores,
                'tipo_trabajo' => $this->tipo_trabajo,
                'descripcion' => $this->descripcion,
                'firma_trabajador' => $this->firma_trabajador,
                'firma_cliente' => $this->firma_cliente,
                'path' => '',

            ]);

            $albaran->moviles()->attach($this->moviles_ids);

            // Insert materiales and update stock if needed
            $pivotData = [];
            foreach ($this->materiales as $mat) {
                // Determine material_id (null if ocasional)
                $matId = empty($mat['material_id']) ? null : $mat['material_id'];
                $pivotData[] = [
                    'albaran_id' => $albaran->id,
                    'material_id' => $matId,
                    'material_ocasional' => $mat['material_ocasional'],
                    'cantidad' => $mat['cantidad'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Update stock logic
                if ($matId && in_array($this->estado, ['entregado', 'retirado'])) {
                    $materialModel = Material::find($matId);
                    if ($materialModel) {
                        if ($this->estado === 'entregado') {
                            $materialModel->decrement('cantidad', $mat['cantidad']);
                        } elseif ($this->estado === 'retirado') {
                            $materialModel->increment('cantidad', $mat['cantidad']);
                        }
                    }
                }
            }
            if (!empty($pivotData)) {
                DB::table('albaran_materiales')->insert($pivotData);
            }

            // Update mobile states and create history entries
            foreach ($this->moviles_ids as $movilId) {
                $movil = Movil::find($movilId);
                if ($movil) {
                    $nuevoEstado = $movil->estado;
                    if ($this->estado === 'entregado') {
                        $nuevoEstado = 'Campo';
                    } elseif ($this->estado === 'retirado') {
                        $nuevoEstado = 'Stock';
                    } elseif ($this->estado === 'pendiente') {
                        $nuevoEstado = 'Preparado';
                    }

                    $movil->update([
                        'empresa_id' => $this->empresa_id,
                        'centro_trabajo_id' => $this->centro_trabajo_id,
                        'estado' => $nuevoEstado,
                    ]);

                    \App\Models\Historial::create([
                        'movil_id' => $movil->id,
                        'albaran_id' => $albaran->id,
                        'estado' => $nuevoEstado,
                        'empresa_id' => $this->empresa_id,
                        'descripcion' => 'Movimiento asociado a Albarán #' . $albaran->id . ' (' . ucfirst($this->estado) . ')',
                    ]);
                }
            }

            $albaran->load(['empresas', 'centrosTrabajos', 'moviles.modelo']);

            ini_set('memory_limit', '512M');
            ini_set('max_execution_time', '300');

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
