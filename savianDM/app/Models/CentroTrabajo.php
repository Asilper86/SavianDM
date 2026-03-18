<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CentroTrabajo extends Model
{
    /** @use HasFactory<\Database\Factories\CentroTrabajoFactory> */
    use HasFactory;

    protected $fillable = ['nombre'];

    public function empresa():BelongsTo{
        return $this->belongsTo(Empresa::class);
    }
}
