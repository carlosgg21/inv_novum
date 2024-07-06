<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
            'unit' => $this->faker->text(255),
            'unit_price' => $this->faker->randomNumber(2),
            'cost_price' => $this->faker->randomNumber(2),
            'size' => $this->faker->text(255),
            'notes' => $this->faker->text(),
            'qty_stock' => $this->faker->randomNumber(0),
            'qty_on_order' => $this->faker->randomNumber(0),
            'category_id' => \App\Models\Category::factory(),
            'brand_id' => \App\Models\Brand::factory(),
            'supplier_id' => \App\Models\Supplier::factory(),
        ];
    }
}
