<?php

namespace Database\Factories;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Inventory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity'          => $this->faker->randomNumber(),
            'min_qty'           => $this->faker->randomNumber(0),
            'max_qty'           => $this->faker->randomNumber(0),
            'quantity_on_order' => $this->faker->randomNumber(0),
            'product_id'        => \App\Models\Product::factory(),
            'location_id'       => \App\Models\Location::factory(),
        ];
    }
}
