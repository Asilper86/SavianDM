<?php

namespace App\Models;

use Database\Factories\ModeloFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Modelo extends Model
{
    /** @use HasFactory<ModeloFactory> */
    use HasFactory;

    protected $fillable = ['nombre'];

    public function moviles(): HasMany
    {
        return $this->hasMany(Movil::class);
    }
}
