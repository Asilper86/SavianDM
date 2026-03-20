<?php

namespace Database\Seeders;

use App\Models\CentroTrabajo;
use App\Models\Empresa;
use App\Models\Modelo;
use App\Models\Movil;
use App\Models\Proveedor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear el usuario admin
        User::factory()->create(['email' => 'admin@savian.com']);

        // 2. CREAR LOS PADRES (Esto evita el error de Foreign Key)
        // Creamos un modelo y un proveedor por defecto para que tengan el ID 1
        $modelo = Modelo::create(['nombre' => 'iPhone 15 Pro']);
        $proveedor = Proveedor::create(['nombre' => 'Proveedor Oficial Savian']);

        // 3. Crear 5 empresas
        Empresa::factory(5)->create()->each(function ($empresa) use ($modelo, $proveedor) {

            // 4. Crear Centros para esta empresa
            $centros = CentroTrabajo::factory(3)->create([
                'empresa_id' => $empresa->id,
            ]);

            // Asignamos el centro principal a la empresa
            $empresa->update(['centroTrabajo_id' => $centros->first()->id]);

            // 5. Crear móviles para cada centro
            foreach ($centros as $centro) {
                Movil::factory(10)->create([
                    'centro_trabajo_id' => $centro->id,
                    'empresa_id' => $empresa->id,
                    'modelo_id' => $modelo->id,    // Usamos el ID del modelo que creamos arriba
                    'proveedor_id' => $proveedor->id, // Usamos el ID del proveedor que creamos arriba
                ]);
            }
        });
    }
}
