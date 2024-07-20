<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::factory()
            ->count(5)
            ->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Currency::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $json = File::get('database/data/currencies.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            Currency::create([
                'id'         => $obj->id,
                'name'       => $obj->name,
                'code'       => $obj->id,
                'acronym'    => $obj->acronym,
                'flag'       => $obj->flag,
                'sign'       => $obj->sign,

            ]);
        }
    }
}
