<?php

namespace App\Livewire\Forms\Albaran;

use App\Models\Albaran;
use App\Models\Movil;
use App\Models\Material;
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

    #[Validate([
        'materiales' => 'nullable|array',
        'materiales.*.material_id' => 'nullable|exists:materiales,id',
        'materiales.*.material_ocasional' => 'nullable|string|max:255',
        'materiales.*.cantidad' => 'required|integer|min:1',
    ])]
    public array $materiales = [];

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
    
    public function addMaterial()
    {
        $this->materiales[] = ['material_id' => '', 'material_ocasional' => '', 'cantidad' => 1];
    }

    public function removeMaterial($index)
    {
        unset($this->materiales[$index]);
        $this->materiales = array_values($this->materiales);
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

        $matRows = DB::table('albaran_materiales')->where('albaran_id', $albaran->id)->get();
        $this->materiales = [];
        foreach ($matRows as $row) {
            $this->materiales[] = [
                'material_id' => $row->material_id,
                'material_ocasional' => $row->material_ocasional,
                'cantidad' => $row->cantidad,
            ];
        }
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

            // Revert stock from old state
            $oldEstado = $this->albaranModel->getOriginal('estado') ?? $this->albaranModel->estado;
            $oldRows = DB::table('albaran_materiales')->where('albaran_id', $this->albaranModel->id)->get();
            if (in_array($oldEstado, ['entregado', 'retirado'])) {
                foreach ($oldRows as $row) {
                    if ($row->material_id) {
                        if ($oldEstado === 'entregado') {
                            Material::where('id', $row->material_id)->increment('cantidad', $row->cantidad);
                        } elseif ($oldEstado === 'retirado') {
                            Material::where('id', $row->material_id)->decrement('cantidad', $row->cantidad);
                        }
                    }
                }
            }

            // Remove old materials
            DB::table('albaran_materiales')->where('albaran_id', $this->albaranModel->id)->delete();

            // Insert new materials and apply new stock
            $pivotData = [];
            foreach ($this->materiales as $mat) {
                $matId = empty($mat['material_id']) ? null : $mat['material_id'];
                $pivotData[] = [
                    'albaran_id' => $this->albaranModel->id,
                    'material_id' => $matId,
                    'material_ocasional' => $mat['material_ocasional'],
                    'cantidad' => $mat['cantidad'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                if ($matId && in_array($this->estado, ['entregado', 'retirado'])) {
                    if ($this->estado === 'entregado') {
                        Material::where('id', $matId)->decrement('cantidad', $mat['cantidad']);
                    } elseif ($this->estado === 'retirado') {
                        Material::where('id', $matId)->increment('cantidad', $mat['cantidad']);
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
                        'albaran_id' => $this->albaranModel->id,
                        'estado' => $nuevoEstado,
                        'empresa_id' => $this->empresa_id,
                        'descripcion' => 'Actualización de Albarán #' . $this->albaranModel->id . ' (' . ucfirst($this->estado) . ')',
                    ]);
                }
            }

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
