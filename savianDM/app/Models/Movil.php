<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movil extends Model
{
    /** @use HasFactory<\Database\Factories\MovilFactory> */
    use HasFactory;

    protected $fillable = ['codigo' , 'tipoCompra' , 'modelo_id' , 'estado' , 'empresa_id' , 'proveedor_id' , 'comentario' ];

    public function modelo():BelongsTo {
        return $this->belongsTo(Modelo::class);
    }

    public function empresa():BelongsTo {
        return $this->belongsTo(Empresa::class);
    }

    public function proveedor() : BelongsTo {
        return $this->belongsTo(Proveedor::class);
    }
}
