<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
// Clear cache before seeding

         Artisan::call('cache:clear');

        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email'    => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(CountrySeeder::class);

$this->call(CitySeeder::class);

        // $this->call(AddressSeeder::class);
        $this->call(AppDefaultSeeder::class);
        $this->call(BankSeeder::class);
        // $this->call(BankAccountSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ChargeSeeder::class);

$this->call(LocationSeeder::class);
$this->call(UnitSeeder::class);

$this->call(PaymentTermSeeder::class);

$this->call(PaymentMethodSeeder::class);

        $this->call(CurrencySeeder::class);

$this->call(TownshipSeeder::class);


        $this->call(CompanySeeder::class);
  
        $this->call(ConditionSeeder::class);



        $this->call(ContactSeeder::class);

        $this->call(SupplierSeeder::class);

$this->call(ProductSeeder::class);

        $this->call(CustomerSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(InventorySeeder::class);
       
        $this->call(InvoiceSeeder::class);
 $this->call(PaymentMadeSeeder::class);
        $this->call(PaymentsReceivedSeeder::class);

        $this->call(PrefixSeeder::class);

        $this->call(PurchaseOrderSeeder::class);
        $this->call(PurchaseOrderItemSeeder::class);
        $this->call(SalesOrderSeeder::class);
        $this->call(SalesOrderItemSeeder::class);


        $this->call(UserSeeder::class);
    }
}
