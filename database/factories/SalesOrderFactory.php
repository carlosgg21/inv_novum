<?php

namespace Database\Factories;

use App\Models\SalesOrder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->text(255),
            'prefix' => $this->faker->text(255),
            'order_date' => $this->faker->date(),
            'invoice_date' => $this->faker->date(),
            'status' => 'not entered',
            'taxes' => $this->faker->randomNumber(2),
            'discount' => $this->faker->randomNumber(2),
            'miscellanues' => $this->faker->randomNumber(2),
            'freight' => $this->faker->randomNumber(2),
            'order_total' => $this->faker->randomNumber(2),
            'notes' => $this->faker->text(),
            'internal_notes' => $this->faker->text(),
            'approved_by' => $this->faker->text(255),
            'customer_id' => \App\Models\Customer::factory(),
            'payment_method_id' => \App\Models\PaymentMethod::factory(),
            'payment_term_id' => \App\Models\PaymentTerm::factory(),
            'sold_by' => \App\Models\Employee::factory(),
        ];
    }
}
