<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code'       => $this->faker->text(255),
            'name'       => $this->faker->name(),
            'acronym'    => $this->faker->text(255),
            'country_id' => $this->faker->randomElement([1, 247]),
        ];
    }
}
