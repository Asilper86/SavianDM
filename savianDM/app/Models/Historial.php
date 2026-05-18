<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Historial extends Model
{
    protected $fillable = ['movil_id', 'albaran_id', 'estado', 'empresa_id', 'descripcion'];

    public function movil():BelongsTo{
        return $this->belongsTo(Movil::class);
    }
    public function albaran():BelongsTo{
        return $this->belongsTo(Albaran::class);
    }
    public function empresa():BelongsTo{
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
}
