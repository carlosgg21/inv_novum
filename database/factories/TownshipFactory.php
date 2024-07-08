<?php

namespace Database\Factories;

use App\Models\Township;
use Illuminate\Database\Eloquent\Factories\Factory;

class TownshipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Township::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'     => $this->faker->name(),
            'code'     => $this->faker->text(255),
            'zip_code' => $this->faker->text(255),
            'city_id'  => $this->faker->randomElement([1, 40]),
        ];
    }
}
