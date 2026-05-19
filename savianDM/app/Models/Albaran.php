<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Albaran extends Model
{
    
    protected $fillable = ['empresa_id', 'movil_id', 'centro_trabajo_id', 'path', 'estado', 'lugar', 'fecha', 'nombre_firmante', 'trabajadores_datos', 'tipo_trabajo', 'descripcion', 'firma_trabajador', 'firma_cliente'];

    protected $casts = [
        'trabajadores_datos' => 'array',
    ];

    public function empresas(): BelongsTo
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function centrosTrabajos(): BelongsTo
    {
        return $this->belongsTo(CentroTrabajo::class, 'centro_trabajo_id');
    }

    public function moviles(): BelongsToMany
    {
        return $this->belongsToMany(
            Movil::class,
            'albaran_movil', // Nombre de la tabla intermedia
            'albaran_id',         // FK en la tabla intermedia que apunta a albarans
            'movil_id'           // FK en la tabla intermedia que apunta a movils
        );
    }

    public function materiales(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'albaran_materiales')
                    ->withPivot('cantidad', 'material_ocasional')
                    ->withTimestamps();
    }
}
