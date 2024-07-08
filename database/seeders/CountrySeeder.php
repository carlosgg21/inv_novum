<?php

namespace Database\Seeders;

use App\Models\Country;
use Carbon\Carbon;
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
        $actives =[
        'AR',  'BR', 'CA', 'CL', 'CO', 'CU', 'CN', 'EC', 'DO', 'FR' , 'PT', 'RU', 'ES', 'GB' , 'US'
        ];

        DB::table('countries')->delete();
        $json = File::get('database/data/countries.json');
        $data = json_decode($json);
        foreach ($data as $obj) {            
            Country::create([
                'id'          => $obj->id,
                'name'        => $obj->name,
                'code'        => $obj->code,
                'iso'         => $obj->iso,
                'flag'        => $obj->flag,
                'time_zone'   => $obj->time_zone,
                'currency_id' => null,
                'deleted_at'  => in_array($obj->code, $actives) ? null : Carbon::now(),

            ]);
        }
    }
}
