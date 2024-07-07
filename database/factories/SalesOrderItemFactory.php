<?php

namespace Database\Factories;

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
            'quantity'       => $this->faker->randomNumber(),
            'unit_price'     => $this->faker->randomNumber(2),
            'total_price'    => $this->faker->randomFloat(2, 10, 500),
            'sales_order_id' => \App\Models\SalesOrder::factory(),
            'product_id'     => $this->faker->randomElement([1, 10]),
        ];
    }
}
