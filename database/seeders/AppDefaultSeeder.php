<?php

namespace Database\Seeders;

use App\Models\AppDefault;
use Illuminate\Database\Seeder;

class AppDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppDefault::factory()
            ->count(5)
            ->create();
    }
}
