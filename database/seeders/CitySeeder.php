<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        City::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $json = File::get('database/data/provinces.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            City::create([
                'id'         => $obj->id,
                'name'       => $obj->name,
                'code'       => $obj->id,
                'acronym'    => $obj->acronym,
                'country_id' => 53,
                'zip_code'   => null,

            ]);
        }
    }
}
