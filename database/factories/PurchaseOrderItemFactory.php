<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\PurchaseOrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PurchaseOrderItem::class;

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
            'qty_received' => $this->faker->randomNumber(0),
            'noted' => $this->faker->text(),
            'product_id' => \App\Models\Product::factory(),
            'purchase_order_id' => \App\Models\PurchaseOrder::factory(),
        ];
    }
}
