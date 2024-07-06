<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentsReceived;

class PaymentsReceivedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentsReceived::factory()
            ->count(5)
            ->create();
    }
}
