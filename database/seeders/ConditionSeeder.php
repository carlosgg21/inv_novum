<?php

namespace Database\Seeders;

use App\Models\Condition;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Condition::factory()
            ->count(5)
            ->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Condition::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();

        $conditions = [
                  [
                      'id'          => 1,
                      'name'        => 'Open',
                      'description' => 'Open',
                      'created_at'  => $now,
                      'updated_at'  => $now,
                  ],
                  [
                      'id'          => 2,
                      'name'        => 'Partially/Received',
                      'description' => 'Partially/Received',
                      'created_at'  => $now,
                      'updated_at'  => $now,
                  ],
                  [
                      'id'          => 3,
                      'name'        => 'Received',
                      'description' => 'Received',
                      'created_at'  => $now,
                      'updated_at'  => $now,
                  ],
                  [
                      'id'          => 4,
                      'name'        => 'Canceled',
                      'description' => 'Canceled',
                      'created_at'  => $now,
                      'updated_at'  => $now,
                  ],
                  [
                      'id'          => 5,
                      'name'        => 'Edited',
                      'description' => 'Edited',
                      'created_at'  => $now,
                      'updated_at'  => $now,
                  ],

              ];

        DB::table('conditions')->insert($conditions);
    }
}
