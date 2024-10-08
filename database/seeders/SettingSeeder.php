<?php

namespace Database\Seeders;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Setting::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $settings = [
            [
                'group' => 'invoice',
                'name' => 'start_with_default_value',
                'value' => '1',
                'type' => 'boolean',
                'description' => 'Use default number start for the invoice in the system',
                'manager_by' => 1,
            ],
            [
                'group' => 'global',
                'name' => 'company_currency',
                'value' => 'CUP',
                'type' => 'string',
                'description' => 'Default bussiness currency operations',
                'manager_by' => 1,
            ],
            [
                'group' => 'sales_order',
                'name' => 'used_prefix',
                'value' => '1',
                'type' => 'boolean',
                'description' => 'Use prefix in Sales Order Number',
                'manager_by' => 1,
            ],

        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
