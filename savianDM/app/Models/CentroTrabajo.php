<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CentroTrabajo extends Model
{
    /** @use HasFactory<\Database\Factories\CentroTrabajoFactory> */
    use HasFactory;

    protected $fillable = ['nombre'];

    protected $table = 'dbo.centro_trabajos';
    public function empresa():BelongsTo{
        return $this->belongsTo(Empresa::class);
    }

    public function movils(): HasMany
    {
        // Asegúrate de que en la tabla 'movils' la columna se llame 'centro_trabajo_id'
        // Si tiene otro nombre, especifícalo como segundo parámetro.
        return $this->hasMany(Movil::class, 'centro_trabajo_id');
    }

    public function albaran():HasMany{
        return $this->hasMany(Albaran::class);
    }
    
}
