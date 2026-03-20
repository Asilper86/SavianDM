<?php

namespace App\Models;

use Database\Factories\MovilFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movil extends Model
{
    /** @use HasFactory<MovilFactory> */
    use HasFactory;

    protected $fillable = [
        'codigo', 'tipoCompra', 'estado', 'modelo_id', 
        'empresa_id', 'proveedor_id', 'centro_trabajo_id', 'comentario'
    ];
    public function modelo(): BelongsTo
    {
        return $this->belongsTo(Modelo::class);
    }

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function centroTrabajo()
    {
        // El segundo parámetro es la clave foránea REAL de tu tabla
        return $this->belongsTo(CentroTrabajo::class, 'centro_trabajo_id');
    }
}
