<?php

namespace Database\Factories;

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
            'quantity'          => $this->faker->randomNumber(),
            'unit_price'        => $this->faker->randomNumber(2),
            'total_price'      => $this->faker->randomFloat(2, 10, 500),
            'qty_received'      => $this->faker->randomNumber(0),
            'noted'             => $this->faker->text(),
            // 'product_id'        => $this->faker->randomElement([1, 10]),
            'purchase_order_id' => \App\Models\PurchaseOrder::factory(),
            'inventory_id' => \App\Models\Inventory::factory(),
        ];
    }
}
