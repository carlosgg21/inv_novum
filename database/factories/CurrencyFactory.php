<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Currency::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'acronym' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'sign' => $this->faker->text(255),
            'code' => $this->faker->text(255),
            'flag' => $this->faker->text(255),
        ];
    }
}
