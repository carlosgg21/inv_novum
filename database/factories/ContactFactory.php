<?php

namespace Database\Factories;

use App\Models\Contact;
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
        $contactableType = $this->faker->randomElement([
                    \App\Models\Supplier::class,
                    \App\Models\Customer::class,
                ]);

        $contactable = $contactableType::factory()->create();

        return [
          
            'identification' => $this->faker->unique()->regexify('[0-9]{11}'),
            'name'             => $this->faker->name(),
            'last_name'        => $this->faker->lastName(),
            'phone'            => $this->faker->phoneNumber(),
            'email'            => $this->faker->email(),
            'address'          => $this->faker->text(),
            'township_id'      => null,
            'city_id'          => null,        
            'country_id'       => $this->faker->randomElement([1, 247]),
            'contactable_type' => $contactableType,
            'contactable_id'   => $contactable->id,
        ];
    }
}
