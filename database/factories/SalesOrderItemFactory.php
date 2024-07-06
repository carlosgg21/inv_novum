<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\SalesOrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesOrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesOrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => $this->faker->randomNumber(),
            'unit_price' => $this->faker->randomNumber(2),
            'total_price' => $this->faker->randomNumber(2),
            'notes' => $this->faker->text(),
            'sales_order_id' => \App\Models\SalesOrder::factory(),
            'product_id' => \App\Models\Product::factory(),
        ];
    }
}
