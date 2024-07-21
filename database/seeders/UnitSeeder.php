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
        'id'          => 1,
        'name'        => 'Almacén Principal',
        'description' => 'Ubicación principal de almacenamiento.',
        'created_at'  => $now,
        'updated_at'  => $now,
    ],
  
];

DB::table('units')->insert($units);

    }
}
