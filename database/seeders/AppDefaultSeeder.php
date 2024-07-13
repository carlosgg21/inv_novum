<?php

namespace Database\Seeders;

use App\Models\AppDefault;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        AppDefault::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $settings = [
            [
                'module'       => 'invoice',
                'name'         => 'invoice_number_start',
                'display_name' => 'Invoice Number Start',
                'value'        => '000001',
                'description'  => 'Number start for the invoice in the system',
                'manager_by'   => 1,
            ],

        ];

        foreach ($settings as $setting) {
            AppDefault::create($setting);
        }
    }
}
