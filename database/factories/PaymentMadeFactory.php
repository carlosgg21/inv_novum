<?php

namespace Database\Factories;

use App\Models\PaymentMade;
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
            'amount'             => $this->faker->randomNumber(2),
            'reference_number'   => $this->faker->text(255),
            'date'               => $this->faker->date(),
            'aproved_by'         => $this->faker->text(255),
            'supplier_id'        => \App\Models\Supplier::factory(),
             'payment_method_id' => $this->faker->randomElement([1, 4]),
            'payment_term_id'    => $this->faker->randomElement([1, 7]),
            'purchase_order_id'  => \App\Models\PurchaseOrder::factory(),
            'created_by'         => \App\Models\Employee::factory(),
        ];
    }
}
