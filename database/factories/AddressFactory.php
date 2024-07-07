<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address'          => $this->faker->text(),
            'zip_code'         => $this->faker->text(255),
            'township_id'      => \App\Models\Township::factory(),
            'city_id'          => \App\Models\City::factory(),
           'country_id' => $this->faker->randomElement([1, 247]),
            'addressable_type' => $this->faker->randomElement([
                \App\Models\Employee::class,
                \App\Models\Company::class,
            ]),
            'addressable_id' => function (array $item) {
                return app($item['addressable_type'])->factory();
            },
        ];
    }
}
