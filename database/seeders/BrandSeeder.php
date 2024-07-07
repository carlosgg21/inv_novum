<?php

namespace Database\Seeders;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Brand::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();

        $brands = [
                    [
                        'id'          => 1,
                        'image'       => 'brands/loreal.jpg',
                        'name'        => 'L\'Oréal',
                        'description' => 'Productos de belleza y cuidado personal de alta calidad.',
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ],
                    [
                        'id'          => 2,
                        'image'       => 'brands/schwarzkopf.jpg',
                        'name'        => 'Schwarzkopf',
                        'description' => 'Especialistas en productos de peluquería profesional.',
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ],
                    [
                        'id'          => 3,
                        'image'       => 'brands/maybelline.jpg',
                        'name'        => 'Maybelline',
                        'description' => 'Maquillaje accesible y moderno para todas.',
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ],
                    [
                        'id'              => 4,
                             'image'      => 'brands/generic-logo.png',
                        'name'            => 'Revlon',
                        'description'     => 'Cosméticos y productos de cuidado personal innovadores.',
                        'created_at'      => $now,
                        'updated_at'      => $now,
                    ],
                    [
                        'id'           => 5,
                          'image'      => 'brands/generic-logo.png',
                        'name'         => 'Dove',
                        'description'  => 'Productos de cuidado personal con ingredientes suaves y naturales.',
                        'created_at'   => $now,
                        'updated_at'   => $now,
                    ],
                    [
                        'id'           => 6,
                          'image'      => 'brands/generic-logo.png',
                        'name'         => 'Pantene',
                        'description'  => 'Cuidado capilar con fórmulas científicamente avanzadas.',
                        'created_at'   => $now,
                        'updated_at'   => $now,
                    ],
                    [
                        'id'           => 7,
                          'image'      => 'brands/generic-logo.png',
                        'name'         => 'Nivea',
                        'description'  => 'Cuidado de la piel y productos de higiene personal confiables.',
                        'created_at'   => $now,
                        'updated_at'   => $now,
                    ],
                    [
                        'id'           => 8,
                          'image'      => 'brands/generic-logo.png',
                        'name'         => 'Matrix',
                        'description'  => 'Marca de peluquería profesional con productos innovadores.',
                        'created_at'   => $now,
                        'updated_at'   => $now,
                    ],
                    [
                        'id'           => 9,
                          'image'      => 'brands/salerm.jpg',
                        'name'         => 'Salerm',
                        'description'  => 'Todo en cosmneticos',
                        'created_at'   => $now,
                        'updated_at'   => $now,
                    ],
                    [
                        'id'           => 10,
                        'image'        => 'brands/generic-logo.png',
                        'name'         => 'Garnier',
                        'description'  => 'Cuidado personal con ingredientes naturales y eficaces.',
                        'created_at'   => $now,
                        'updated_at'   => $now,
                    ],
                ];

        DB::table('brands')->insert($brands);
    }
}
