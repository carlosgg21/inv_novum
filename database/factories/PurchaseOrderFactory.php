<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PurchaseOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->text(255),
            'order_date' => $this->faker->date(),
            'total_amount' => $this->faker->randomNumber(2),
            'status' => 'not entered',
            'taxes' => $this->faker->randomNumber(2),
            'discount' => $this->faker->randomNumber(2),
            'miscellaneus' => $this->faker->randomNumber(2),
            'shipping_date' => $this->faker->date(),
            'shipping_cost' => $this->faker->randomNumber(2),
            'shippin_tracking_number' => $this->faker->text(255),
            'received_date' => $this->faker->date(),
            'billable' => $this->faker->boolean(),
            'supplier_id' => \App\Models\Supplier::factory(),
            'payment_method_id' => \App\Models\PaymentMethod::factory(),
            'payment_term_id' => \App\Models\PaymentTerm::factory(),
            'condition_id' => \App\Models\Condition::factory(),
        ];
    }
}
