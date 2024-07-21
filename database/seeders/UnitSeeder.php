<?php

namespace Database\Seeders;

use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Unit::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();

        $units = [
            [
                'name'        => 'Unidades',
                'abbreviation' => 'u',
                'description' => 'Utilizada para contar productos individuales como pinceles, esponjas, o productos de maquillaje.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Pomos',
                'abbreviation' => 'pump',
                'description' => 'Se refiere a productos envasados en frascos con dispensador de bomba, como lociones y jabones líquidos.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Frascos',
                'abbreviation' => 'bottle',
                'description' => 'Unidad para medir productos envasados en frascos, como perfumes o aceites esenciales',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Cajas',
                'abbreviation' => 'box',
                'description' => 'Usada para contar productos empaquetados en cajas, como kits de maquilla',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Bolsas',
                'abbreviation' => 'bag',
                'description' => 'Para productos que se venden en bolsas, como muestras o productos sueltoss',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Rollos',
                'abbreviation' => 'roll',
                'description' => 'Para productos como papel de depilación o roll-ons de fragancias.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Pares',
                'abbreviation' => 'pr',
                'description' => ' Usada para contar productos que vienen en pares, como pestañas postizas',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Tubos',
                'abbreviation' => 'tube',
                'description' => 'Unidad para medir productos envasados en tubos, como cremas para manos o dentífricos',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],

        ];

        DB::table('units')->insert($units);
    }
}
