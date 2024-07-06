<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InventoryDetail;

class InventoryDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InventoryDetail::factory()
            ->count(5)
            ->create();
    }
}
