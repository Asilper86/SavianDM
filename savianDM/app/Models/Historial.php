<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Historial extends Model
{
    protected $fillable = ['movil_id', 'fecha', 'empresa_id', 'estado', 'albaran_id'];

    public function movil():BelongsTo{
        return $this->belongsTo(Movil::class);
    }
    public function albaran():BelongsTo{
        return $this->belongsTo(Albaran::class);
    }
    public function empresa():BelongsTo{
        return $this->belongsTo(Empresa::class);
    }
}
