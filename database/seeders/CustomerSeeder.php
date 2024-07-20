<?php

namespace Database\Seeders;

use App\Models\Customer;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Customer::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = Faker::create();

        $customers = [
            [
                'name'    => 'Acme Corporation',
                'phone'   => '555-1234',
                'email'   => 'info@acmecorp.com',
                'address' => '123 Main St, Anytown USA',
            ],
            [
                'name'    => 'Global Tech Solutions',
                'phone'   => '555-5678',
                'email'   => 'sales@globaltechsolutions.com',
                'address' => '456 Oak Rd, Somewhere City',
            ],
            [
                'name'    => 'Innovative Enterprises',
                'phone'   => '555-9012',
                'email'   => 'contact@innovativeenterprises.com',
                'address' => '789 Elm St, Othertown',
            ],
            [
                'name'    => 'Synergy Consulting Group',
                'phone'   => '555-3456',
                'email'   => 'info@synergyconsulting.com',
                'address' => '321 Pine Ave, Somewhere Else',
            ],
            [
                'name'    => 'Apex Manufacturing',
                'phone'   => '555-7890',
                'email'   => 'orders@apexmanufacturing.com',
                'address' => '654 Oak St, Anyplace',
            ],
        ];

        foreach ($customers as $customerData) {
            $customer = Customer::create($customerData);

            $customer->addresses()->create([
                'address'        => $faker->address(),
                'township_id'    => null,
                'city_id'        => null,
                'country_id'     => rand(1, 100) ,
                'zip_code'       => $faker->numerify('#######'),
                'default'        => 1,

            ]);

            $customer->contacts()->create([
                 'identification'           => $faker->unique()->regexify('[0-9]{11}'),
                'name'                      => $faker->name(),
                'last_name'                 => $faker->lastName(),
                'phone'                     => $faker->phoneNumber(),
                'email'                     => $faker->email(),
                           'address'        => $faker->address(),
            ]);

            $customer->bankAccounts()->create([
                   'number'          => Crypt::encrypt('0542-3454-5678-9810'),
                   'type'            => null,
                   'bank_id'         => rand(1, 6),
                   'currency_id'     => rand(1, 22),
                   'default'         => 1,

               ]);
        }
    }
}
