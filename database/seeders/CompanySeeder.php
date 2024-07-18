<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
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
        DB::table('addresses')->truncate();
        DB::table('company_contacts')->truncate();
        DB::table('bank_accounts')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $company = Company::create([
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

        $company->address()->create([
            'address'        => 'Calle Falsa 123',
            'township_id'    => 23,
            'city_id'        => 23,
            'country_id'     => 53 ,
            'zip_code'       => 10400 ,
            'default'        => 1,

        ]);

        $company->bankAccounts()->create([
            'number'          => Crypt::encrypt('0542-3454-5678-9810'),
            'type'            => null,
            'bank_id'         => 1,
            'currency_id'     => 8,
            'default'         => 1,

        ]);

        $company->companyContacts()->create([
            'name'          => 'Shaun Labadie',
            'last_name'     => 'White',
            'phone'         => '+1-563-944-8441',
            'email'         => 'baumbach.vicenta@kunze.com',
            'social_media'  => [],
            'title'         => null,
            'company_id'    => 1,
            'charge_id'     => 1,
            'boss'         => 1,
        ]);
    }
}
