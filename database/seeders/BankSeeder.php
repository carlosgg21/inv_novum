<?php

namespace Database\Seeders;

use App\Models\Bank;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Bank::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();

        $banks = [
                    [
                        'id'             => 1,
                        'logo'           => 'banks/metro.jpg',
                        'name'           => 'Banco Metropolitano',
                        'acronym'        => 'Metro',
                        'description'    => 'EL banco de la capital',
                        'created_at'     => $now,
                        'updated_at'     => $now,
                    ],
                    [
                        'id'             => 2,
                        'logo'           => 'banks/bpa.jpg',
                        'name'           => 'Banco Popular de Ahorro',
                        'acronym'        => 'BPA',
                        'description'    => '',
                        'created_at'     => $now,
                        'updated_at'     => $now,
                    ],
                    [
                        'id'             => 3,
                        'logo'           => 'banks/bandec.jpg',
                        'name'           => 'Banco de Credito y Comercio',
                        'acronym'        => 'BANDEC',
                        'description'    => '',
                        'created_at'     => $now,
                        'updated_at'     => $now,
                    ],
                    [
                        'id'             => 4,
                        'logo'           => 'banks/bicsa.jpg',
                        'name'           => 'Banco Internacional de Comercio S.A',
                        'acronym'        => 'BICSA',
                        'description'    => 'EL banco de la capital',
                        'created_at'     => $now,
                        'updated_at'     => $now,
                    ],
                    [
                        'id'             => 5,
                        'logo'           => 'banks/bec.jpg',
                        'name'           => 'Banco Exterior de Cuba',
                        'acronym'        => 'BEC',
                        'description'    => '',
                        'created_at'     => $now,
                        'updated_at'     => $now,
                    ],
                    [
                        'id'             => 6,
                        'logo'           => 'banks/bfi.jpg',
                        'name'           => 'Banco Finaciero Internacional',
                        'acronym'        => 'BFI',
                        'description'    => '',
                        'created_at'     => $now,
                        'updated_at'     => $now,
                    ],

                ];

        DB::table('banks')->insert($banks);
    }
}
