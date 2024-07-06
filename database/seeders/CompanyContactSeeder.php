<?php

namespace Database\Seeders;

use App\Models\CompanyContact;
use Illuminate\Database\Seeder;

class CompanyContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyContact::factory()
            ->count(5)
            ->create();
    }
}
