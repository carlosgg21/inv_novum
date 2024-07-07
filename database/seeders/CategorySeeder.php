<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();

        $categories = [
                  [
                      'id'          => 1,
                      'name'        => 'Cuidado Facial',
                      'description' => 'Productos para el cuidado facial.',
                      'created_at'  => $now,
                      'updated_at'  => $now,
                  ],
                  [
                      'id'          => 2,
                      'name'        => 'Maquillaje',
                      'description' => 'Productos de maquillaje.',
                      'created_at'  => $now,
                      'updated_at'  => $now,
                  ],
                  [
                      'id'          => 3,
                      'name'        => 'Cuidado Capilar',
                      'description' => 'Productos para el cuidado del cabello.',
                      'created_at'  => $now,
                      'updated_at'  => $now,
                  ],
                  [
                      'id'          => 4,
                      'name'        => 'Cuidado Corporal',
                      'description' => 'Productos para el cuidado corporal.',
                      'created_at'  => $now,
                      'updated_at'  => $now,
                  ],
                  [
                      'id'          => 5,
                      'name'        => 'Fragancias',
                      'description' => 'Fragancias y perfumes.',
                      'created_at'  => $now,
                      'updated_at'  => $now,
                  ],
                  [
                      'id'          => 6,
                      'name'        => 'Higiene Personal',
                      'description' => 'Productos de higiene personal.',
                      'created_at'  => $now,
                      'updated_at'  => $now,
                  ],
                  [
                      'id'          => 7,
                      'name'        => 'Cuidado Oral',
                      'description' => 'Productos para el cuidado oral.',
                      'created_at'  => $now,
                      'updated_at'  => $now,
                  ],
                  [
                      'id'          => 8,
                      'name'        => 'Accesorios de Belleza',
                      'description' => 'Accesorios de belleza y cuidado personal.',
                      'created_at'  => $now,
                      'updated_at'  => $now,
                  ],
                  [
                      'id'          => 9,
                      'name'        => 'Cuidado de Manos y Pies',
                      'description' => 'Productos para el cuidado de manos y pies.',
                      'created_at'  => $now,
                      'updated_at'  => $now,
                  ],
                  [
                      'id'          => 10,
                      'name'        => 'Cuidado Intimo',
                      'description' => 'Productos para el cuidado íntimo.',
                      'created_at'  => $now,
                      'updated_at'  => $now,
                  ],
              ];

        DB::table('categories')->insert($categories);
    }
}
