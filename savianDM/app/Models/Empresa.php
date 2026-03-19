<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empresa extends Model
{
    /** @use HasFactory<\Database\Factories\EmpresaFactory> */
    use HasFactory;

    protected $fillable = ['nombre', 'centroTrabajo_id', 'hectarea'];

    public function centro_trabajos():HasFactory{
        return $this->hasMany(CentroTrabajo::class);
    }

    public function Historial():HasMany{
        return $this->hasMany(Historial::class);
    }
}
