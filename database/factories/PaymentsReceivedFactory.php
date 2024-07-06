<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\PaymentsReceived;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentsReceivedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentsReceived::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomNumber(2),
            'date' => $this->faker->date(),
            'notes' => $this->faker->text(),
            'payment_method_id' => \App\Models\PaymentMethod::factory(),
            'payment_term_id' => \App\Models\PaymentTerm::factory(),
            'invoice_id' => \App\Models\Invoice::factory(),
            'sales_order_id' => \App\Models\SalesOrder::factory(),
            'customer_id' => \App\Models\Customer::factory(),
            'received_id' => \App\Models\Employee::factory(),
        ];
    }
}
