<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => $this->faker->name(),
            'code'        => $this->faker->text(255),
            'iso'         => $this->faker->text(255),
            'time_zone'   => $this->faker->text(255),
            'flag'        => $this->faker->text(255),
            'currency_id' => $this->faker->randomElement([1, 22]),
        ];
    }
}
