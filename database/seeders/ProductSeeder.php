<?php

namespace Database\Seeders;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();

        $products = [
            [
                'id'          => 1,
                'code'        => 'PROD001',
                'image'       => 'product1.jpg',
                'name'        => 'Crema Facial Hidratante',
                'description' => 'Crema facial hidratante para todo tipo de piel.',
                'unit_id'        => rand(1, 8),
                'unit_price'  => 29.99,
                'cost_price'  => 15.99,
                'size'        => '50 ml',
                'category_id' => 1,
                'brand_id'    => 1,           
                'notes'       => 'Ideal para pieles sensibles.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 2,
                'code'        => 'PROD002',
                'image'       => 'product2.jpg',
                'name'        => 'Base de Maquillaje Líquida',
                'description' => 'Base de maquillaje líquida de larga duración.',
                    'unit_id'        => rand(1, 8),
                'unit_price'  => 19.99,
                'cost_price'  => 12.99,
                'size'        => '30 ml',
                'category_id' => 2,
                'brand_id'    => 3,     
                'notes'       => 'Para todo tipo de tonos de piel.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 3,
                'code'        => 'PROD003',
                'image'       => 'product3.jpg',
                'name'        => 'Champú Reparador',
                'description' => 'Champú reparador para cabello dañado.',
                   'unit_id'        => rand(1, 8),
                'unit_price'  => 12.99,
                'cost_price'  => 8.99,
                'size'        => '250 ml',
                'category_id' => 3,
                'brand_id'    => 6,
                'notes'       => 'Con ingredientes naturales.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 4,
                'code'        => 'PROD004',
                'image'       => 'product4.jpg',
                'name'        => 'Gel de Ducha Nutritivo',
                'description' => 'Gel de ducha nutritivo con ingredientes naturales.',
              'unit_id'        => rand(1, 8),
                'unit_price'  => 8.99,
                'cost_price'  => 5.99,
                'size'        => '200 ml',
                'category_id' => 4,
                'brand_id'    => 7,           
                'notes'       => 'Para una piel suave y fresca.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 5,
                'code'        => 'PROD005',
                'image'       => 'product5.jpg',
                'name'        => 'Perfume Floral',
                'description' => 'Perfume floral con notas frescas y duraderas.',
                 'unit_id'        => rand(1, 8),
                'unit_price'  => 39.99,
                'cost_price'  => 28.99,
                'size'        => '50 ml',
                'category_id' => 5,
                'brand_id'    => 2,
                'notes'       => 'Ideal para ocasiones especiales.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 6,
                'code'        => 'PROD006',
                'image'       => 'product6.jpg',
                'name'        => 'Desodorante Roll-On',
                'description' => 'Desodorante roll-on de larga duración.',
                     'unit_id'        => rand(1, 8),
                'unit_price'  => 5.99,
                'cost_price'  => 3.99,
                'size'        => '50 ml',
                'category_id' => 6,
                'brand_id'    => 8,           
                'notes'       => 'Fórmula sin alcohol.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 7,
                'code'        => 'PROD007',
                'image'       => 'product7.jpg',
                'name'        => 'Dentífrico Blanqueador',
                'description' => 'Dentífrico blanqueador para dientes sensibles.',
                   'unit_id'        => rand(1, 8),
                'unit_price'  => 7.99,
                'cost_price'  => 4.99,
                'size'        => '75 ml',
                'category_id' => 7,
                'brand_id'    => 7,           
                'notes'       => 'Protege el esmalte dental.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 8,
                'code'        => 'PROD008',
                'image'       => 'product8.jpg',
                'name'        => 'Set de Brochas de Maquillaje',
                'description' => 'Set de brochas profesionales para maquillaje.',
                  'unit_id'        => rand(1, 8),
                'unit_price'  => 24.99,
                'cost_price'  => 18.99,
                'size'        => null,
                'category_id' => 8,
                'brand_id'    => 10,
                'notes'       => 'Incluye brochas de diferentes tamaños.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 9,
                'code'        => 'PROD009',
                'image'       => 'product9.jpg',
                'name'        => 'Aceite para Cutículas',
                'description' => 'Aceite nutritivo para cutículas de manos y pies.',
                    'unit_id'        => rand(1, 8),
                'unit_price'  => 9.99,
                'cost_price'  => 6.99,
                'size'        => '10 ml',
                'category_id' => 9,
                'brand_id'    => 4,           
                'notes'       => 'Con vitamina E.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 10,
                'code'        => 'PROD010',
                'image'       => 'product10.jpg',
                'name'        => 'Toallitas Íntimas',
                'description' => 'Toallitas íntimas suaves y biodegradables.',
                     'unit_id'        => rand(1, 8),
                'unit_price'  => 3.99,
                'cost_price'  => 2.99,
                'size'        => null,
                'category_id' => 10,
                'brand_id'    => 5,           
                'notes'       => 'Adecuadas para pieles sensibles.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        DB::table('products')->insert($products);
    }
}
