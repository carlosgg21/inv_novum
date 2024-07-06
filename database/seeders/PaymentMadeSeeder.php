<?php

namespace Database\Seeders;

use App\Models\PaymentMade;
use Illuminate\Database\Seeder;

class PaymentMadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMade::factory()
            ->count(5)
            ->create();
    }
}
