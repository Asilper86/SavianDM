<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    /** @use HasFactory<\Database\Factories\EmpresaFactory> */
    use HasFactory;

    protected $fillable = ['nombre', 'centroTrabajo_id', 'hectarea'];

    public function centroTrabajos():HasFactory{
        return $this->hasMany(CentroTrabajo::class);
    }

    public function Historial():HasFactory{
        return $this->hasMany(Historial::class);
    }
}
