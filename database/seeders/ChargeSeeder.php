<?php

namespace Database\Seeders;

use App\Models\Charge;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Charge::factory()
            ->count(5)
            ->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Charge::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();

        $charges = [
            [
                'name'        => 'Gerente de Tienda',
                'description' => 'Responsable de la operación general de la tienda.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Asistente de Gerente',
                'description' => 'Apoya al gerente en tareas diarias y supervisión del personal.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Vendedor',
                'description' => 'Atención al cliente, asesoramiento y cierre de ventas.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Especialista en Belleza',
                'description' => 'Asesoramiento especializado en productos de belleza y demostraciones.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Cajero',
                'description' => 'Gestión de transacciones y registros de caja.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],

                ];

        DB::table('charges')->insert($charges);
    }
}
