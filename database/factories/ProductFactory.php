<?php

namespace Database\Factories;

use App\Models\Product;
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
        $units = ['kg', 'liter', 'piece', 'pack', 'box'];

        return [
            'code'           => $this->faker->unique()->regexify('[0-9]{6}'),
            'name'           => $this->faker->name(),
            'description'    => $this->faker->sentence(15),
            'unit'           => $this->faker->randomElement($units),
            'unit_price'     => $this->faker->randomFloat(2, 1, 100),
            'cost_price'     => $this->faker->randomFloat(2, 1, 100),
            'size'           => $this->faker->randomElement(['small', 'medium', 'large']),
            'notes'          => $this->faker->text(),
            'category_id'    => $this->faker->randomElement([1, 10]),
            'brand_id'       => $this->faker->randomElement([1, 10]),
            'supplier_id'    => $this->faker->randomElement([1, 5]),
        ];
    }
}
