<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Albaran extends Model
{
    
    protected $fillable = ['empresa_id', 'movil_id', 'centro_trabajo_id', 'path', 'estado'];

    public function empresas(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    public function centrosTrabajos(): BelongsTo
    {
        return $this->belongsTo(CentroTrabajo::class);
    }

    public function moviles(): BelongsToMany
    {
        return $this->belongsToMany(
            Movil::class,
            'dbo.albaran_movil', // Nombre de la tabla intermedia
            'albaran_id',         // FK en la tabla intermedia que apunta a albarans
            'movil_id'           // FK en la tabla intermedia que apunta a movils
        );
    }
}
