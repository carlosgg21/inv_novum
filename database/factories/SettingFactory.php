<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'group' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'value' => $this->faker->text(),
            'type' => $this->faker->word(),
            'description' => $this->faker->sentence(15),
            'manager_by' => $this->faker->randomNumber(0),
        ];
    }
}
