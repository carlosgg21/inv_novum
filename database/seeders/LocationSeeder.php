<?php

namespace Database\Seeders;

use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Location::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();

        $locations = [
            [
                'id'          => 1,
                'name'        => 'Almacén Principal',
                'description' => 'Ubicación principal de almacenamiento.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 2,
                'name'        => 'Depósito A',
                'description' => 'Depósito A para productos en tránsito.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 3,
                'name'        => 'Estantería 1',
                'description' => 'Estantería 1 para productos de cuidado personal.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 4,
                'name'        => 'Estante de Exhibición',
                'description' => 'Estante de exhibición para productos promocionales.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        DB::table('locations')->insert($locations);
    }
}
