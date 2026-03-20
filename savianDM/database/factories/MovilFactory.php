<?php

namespace Database\Factories;

use App\Models\CentroTrabajo;
use App\Models\Movil;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Movil>
 */
class MovilFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => fake()->unique()->bothify('MOV-####'),
            'tipoCompra' => fake()->randomElement(['Propio', 'Alquilado']),
            'estado' => fake()->randomElement(['Bien', 'Roto']),
            'modelo_id' => 1, // O Modelo::factory()
            'empresa_id' => 1,
            'proveedor_id' => 1,
            'centro_trabajo_id' => 1, // <--- AQUÍ ESTABA EL ERROR
            'comentario' => fake()->sentence(),
        ];
    }
}
