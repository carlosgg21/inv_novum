<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->text(255),
            'date' => $this->faker->date(),
            'total_amount' => $this->faker->randomNumber(2),
            'status' => $this->faker->word(),
            'year' => $this->faker->text(255),
            'mount' => $this->faker->randomNumber(0),
            'notes' => $this->faker->text(),
            'sales_order_id' => \App\Models\SalesOrder::factory(),
            'employee_id' => \App\Models\Employee::factory(),
            'currency_id' => \App\Models\Currency::factory(),
        ];
    }
}
