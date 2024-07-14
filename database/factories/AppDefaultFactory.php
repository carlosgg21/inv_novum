<?php

namespace Database\Factories;

use App\Models\AppDefault;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppDefaultFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AppDefault::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'module' => $this->faker->text(),
            'name' => $this->faker->name(),
            'display_name' => $this->faker->text(255),
            'value' => $this->faker->text(),
            'description' => $this->faker->sentence(15),
            'manager_by' => $this->faker->boolean(),
        ];
    }
}
