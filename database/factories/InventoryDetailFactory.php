<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\InventoryDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventoryDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'batch_number' => $this->faker->text(255),
            'expire_date' => $this->faker->date(),
            'unit_cost' => $this->faker->randomNumber(2),
            'inventory_id' => \App\Models\Inventory::factory(),
        ];
    }
}
