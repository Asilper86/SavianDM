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
