<?php

namespace Database\Seeders;

use App\Models\Township;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TownshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Township::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        
        $json = File::get('database/data/townships.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            Township::create([
                'name'        => $obj->name,
                'city_id' => $obj->province_id,
                'code'        => $obj->code,

            ]);
        }
    }
}
