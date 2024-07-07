<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory()
            ->count(5)
            ->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Company::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Company::create([
                    'code'         => '520100',
                    'name'         => 'Demo',
                    'acronym'      => 'Dmo',
                    'logo'         => 'images/generic-logo.png',
                    'slogan'       => 'Optimiza tu negocio con un manejo avanzado de inventarios',
                    'phone'        => '789963366',
                    'email'        => 'enterpise@novum.com',
                    'web_site'     => 'hhtp://www.enterpise-novum.com',
                    'social_media' => [],
                    'address'      => 'Calle Falsa 123, Ciudadela, No. 12345',
                    'qr_code'      => 'images/qrcode.png',
            ]);
    }
}
