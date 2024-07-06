<?php

namespace Database\Factories;

use App\Models\PaymentMade;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentMadeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentMade::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomNumber(2),
            'reference_number' => $this->faker->text(255),
            'date' => $this->faker->date(),
            'aproved_by' => $this->faker->text(255),
            'supplier_id' => \App\Models\Supplier::factory(),
            'payment_method_id' => \App\Models\PaymentMethod::factory(),
            'payment_term_id' => \App\Models\PaymentTerm::factory(),
            'purchase_order_id' => \App\Models\PurchaseOrder::factory(),
            'created_by' => \App\Models\Employee::factory(),
        ];
    }
}
