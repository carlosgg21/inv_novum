<?php

namespace Database\Factories;

use App\Models\CompanyContact;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompanyContact::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'         => $this->faker->name(),
            'last_name'    => $this->faker->lastName(),
            'phone'        => $this->faker->phoneNumber(),
            'email'        => $this->faker->email(),
            'social_media' => [],
            'title'        => $this->faker->sentence(10),
            'boss'         => $this->faker->boolean(),
            'company_id'   => 1,
            'charge_id'    => $this->faker->randomElement([1, 5]),
        ];
    }
}
