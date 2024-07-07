<?php

namespace Database\Seeders;

use App\Models\PaymentTerm;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentTerm::factory()
            ->count(5)
            ->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PaymentTerm::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();

        $paymentTerms = [
            [
                'id'                 => 1,
                'code'               => 'COD',
                'description'        => 'Cash on Delivery', //El pago es debido en el momento de la entrega de los bienes
                'day'                => 0,
                'created_at'         => $now,
                'updated_at'         => $now,
            ],
            [
                'id'                 => 2,
                'code'               => 'N30',
                'description'        => 'Net 30', //El pago completo es debido 30 días después de la fecha de la factura.
                'day'                => 30,
                'created_at'         => $now,
                'updated_at'         => $now,
            ],

            [
                'id'                 => 3,
                'code'               => 'N45',
                'description'        => 'Net 45', //El pago completo es debido 45 días después de la fecha de la factura.
                'day'                => 45,
                'created_at'         => $now,
                'updated_at'         => $now,
            ],
            [
                'id'          => 4,
                'code'        => 'N60',
                'description' => 'Net 60', //El pago completo es debido 60 días después de la fecha de la factura.
                'day'         => 60,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'                 => 5,
                'code'               => 'N90',
                'description'        => 'Net 90', //El pago completo es debido 90 días después de la fecha de la factura.
                'day'                => 90,
                'created_at'         => $now,
                'updated_at'         => $now,
            ],
            [
                'id'                 => 6,
                'code'               => 'Due on Receipt',
                'description'        => 'Due on Receipt', //El pago es debido inmediatamente al recibir la factura.
                'day'                => 90,
                'created_at'         => $now,
                'updated_at'         => $now,
            ],
            [
                'id'                 => 7,
                'code'               => 'Prepayment',
                'description'        => 'Prepayment', //El pago completo es debido 15 días después de la fecha de la factura
                'day'                => 90,
                'created_at'         => $now,
                'updated_at'         => $now,
            ],

        ];

        DB::table('payment_terms')->insert($paymentTerms);
    }
}
