<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'acronym' => $this->faker->text(255),
            'logo' => $this->faker->text(255),
            'slogan' => $this->faker->text(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'web_site' => $this->faker->text(255),
            'social_media' => [],
            'address' => $this->faker->text(),
            'qr_code' => $this->faker->text(255),
        ];
    }
}
