<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('countries')->delete();
        $json = File::get('database/data/countries.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            Country::create([
                'id'   => $obj->id,
                'name' => $obj->name,
                'code' => $obj->code,
                'iso' => $obj->iso,
                'flag' => $obj->flag,
                'time_zone' => $obj->time_zone,
                'currency_id' => null

            ]);
        }
    }
}
