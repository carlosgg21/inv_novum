<?php

namespace Database\Seeders;


use App\Models\Prefix;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PrefixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Prefix::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = Faker::create();

        $modules = ['invoice', 'sales_order', 'purchase_order', 'customer', 'employee'];
        $shortNames = ['INV', 'PO', 'SO', 'CUS', 'EMP', 'SUP', 'PROD', 'INV'];

        // Iterar sobre los módulos para crear un registro por cada uno
        foreach ($modules as $key => $module) {
            $shortName = $shortNames[$key];

            $name = str_replace('_', ' ', ucfirst($module));

            Prefix::create([
                'name' => $name,
                'display' => $shortName,
                'description' => $faker->sentence(15),
                'used_in' => $module,
                'star_number' => $faker->randomNumber(0),
                'position' => $faker->randomNumber(0),
            ]);
        }

    }
}
