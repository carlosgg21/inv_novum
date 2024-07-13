<?php

namespace Database\Factories;

use App\Models\Invoice;
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
        $date = $this->faker->dateTimeBetween('-20 years', 'now');
        $year = $date->format('Y');
        $month = $date->format('n'); // 'n' returns month without leading zeros

        $statuses = [
            'open' => 'open',
            'aceptada' => 'accepted',
            'paid' => 'paid',
            'clouse' => 'closed',
            'cancelada' => 'cancelled',
        ];

        $status = $this->faker->randomElement($statuses);

        return [
            'number'         => $this->faker->unique()->regexify('[0-9]{6}'),
            'date'           => $date,
            'total_amount'   => $this->faker->randomNumber(2),
            'status'         => $status,
            'year'           => $year,
            'month'          => $month,
            'notes'          => $this->faker->text(),
            'sales_order_id' => \App\Models\SalesOrder::factory(),
            'employee_id'    => \App\Models\Employee::factory(),
            'currency_id'    => $this->faker->randomElement([1, 22]),
        ];
    }
}
