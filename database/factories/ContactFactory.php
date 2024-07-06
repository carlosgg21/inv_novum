<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'identication' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'last_name' => $this->faker->lastName(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'address' => $this->faker->text(),
            'township_id' => \App\Models\Township::factory(),
            'city_id' => \App\Models\City::factory(),
            'country_id' => \App\Models\Country::factory(),
            'contactable_type' => $this->faker->randomElement([
                \App\Models\Supplier::class,
                \App\Models\Customer::class,
            ]),
            'contactable_id' => function (array $item) {
                return app($item['contactable_type'])->factory();
            },
        ];
    }
}
