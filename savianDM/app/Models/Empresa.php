<?php

namespace App\Models;

use Database\Factories\EmpresaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empresa extends Model
{
    /** @use HasFactory<EmpresaFactory> */
    use HasFactory;

    protected $fillable = ['nombre', 'centroTrabajo_id', 'hectarea'];

    public function centroTrabajo()
    {
        // Usamos el nombre exacto de la columna en la base de datos: centroTrabajo_id
        return $this->belongsTo(CentroTrabajo::class, 'centroTrabajo_id');
    }

    public function Historial(): HasMany
    {
        return $this->hasMany(Historial::class);
    }

    public function movils(): HasMany
    {
        return $this->hasMany(Movil::class);
    }
}
