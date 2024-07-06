<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CountySeeder extends Seeder
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
            $slug = Str::slug($obj->name, '-');
            Country::create([
                'id'   => $obj->id,
                'name' => $obj->name,
                'code' => $obj->code,
                'slug' => $slug,
            ]);
        }
    }
}
