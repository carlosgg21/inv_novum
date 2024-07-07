<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PaymentMethod::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();

        $paymentMethods = [
            [
                'id'          => 1,
                'code'        => 'wire_transfer',
                'name'        => 'Wire Transfer',
                'description' => '',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 2,
                'code'        => 'check',
                'name'        => 'Check',
                'description' => '',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 3,
                'code'        => 'cash',
                'name'        => 'Cash',
                'description' => '',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 4,
                'code'        => 'card',
                'name'        => 'Card',
                'description' => '',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        DB::table('payment_methods')->insert($paymentMethods);
    }
}
