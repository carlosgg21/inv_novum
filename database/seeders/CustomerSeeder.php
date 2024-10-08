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
                'notes' => null,
                'payment_method_id' => '4',
                'payment_term_id' => '1',

            ],
            [
                'name'    => 'Global Tech Solutions',
                'phone'   => '555-5678',
                'email'   => 'sales@globaltechsolutions.com',
                'notes' => null,
                'payment_method_id' => '4',
                'payment_term_id' => '5',
            ],
            [
                'name'    => 'Innovative Enterprises',
                'phone'   => '555-9012',
                'email'   => 'contact@innovativeenterprises.com',
                'notes' => null,
                'payment_term_id' => '4',
            ],
            [
                'name'    => 'Synergy Consulting Group',
                'phone'   => '555-3456',
                'email'   => 'info@synergyconsulting.com',
                'notes' => null,
                'payment_method_id' => '3',
                'payment_term_id' => '4',
            ],
            [
                'name'    => 'Apex Manufacturing',
                'phone'   => '555-7890',
                'email'   => 'orders@apexmanufacturing.com',
                'notes' => null,
                'payment_method_id' => '1',
                'payment_term_id' => '3',
            ],
        ];

        foreach ($customers as $customerData) {
            $customer = Customer::create($customerData);

            $customer->addresses()->create([
                'address'        => $faker->address(),
                'township_id'    => null,
                'city_id'        => null,
                'country_id'     => rand(1, 100),
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
