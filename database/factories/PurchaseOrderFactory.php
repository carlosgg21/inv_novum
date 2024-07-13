<?php

namespace Database\Factories;

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
            'number'                  => $this->faker->unique()->regexify('[0-9]{6}'),
            'order_date'              => $this->faker->date(),
            'total_amount'            => $this->faker->randomFloat(2, 10, 500),
            'status'                  => $this->faker->randomElement(['not entered', 'entered']),
            'taxes'                   => $this->faker->randomFloat(2, 0, 50),
            'discount'                => $this->faker->randomFloat(2, 0, 20),
            'miscellaneous'           => $this->faker->randomFloat(2, 0, 30),
            'shipping_date'           => $this->faker->date(),
           'shipping_cost'            => $this->faker->randomFloat(2, 0, 50),
            'shippin_tracking_number' => $this->faker->text(255),
            'received_date'           => $this->faker->date(),
            'billable'                => $this->faker->boolean(),
            'supplier_id'             => \App\Models\Supplier::factory(),
            'payment_method_id'       => $this->faker->randomElement([1, 4]),
            'payment_term_id'         => $this->faker->randomElement([1, 7]),
            'condition_id'            => $this->faker->randomElement([1, 5]),
        ];
    }
}
