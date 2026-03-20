<?php

namespace Database\Factories;

use App\Models\CentroTrabajo;
use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CentroTrabajo>
 */
class CentroTrabajoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => 'Sede ' . fake()->city(),
            'empresa_id' => Empresa::factory(),
        ];
    }
}
