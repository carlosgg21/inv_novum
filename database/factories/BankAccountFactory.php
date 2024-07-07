<?php

namespace Database\Factories;

use App\Models\BankAccount;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankAccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BankAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->text(255),
            'type' => $this->faker->word(),
            'bank_id' => \App\Models\Bank::factory(),
            'currency_id' => $this->faker->randomElement([1, 22]),
            'bank_accountable_type' => $this->faker->randomElement([
                \App\Models\Supplier::class,
                \App\Models\Customer::class,
                \App\Models\Company::class,
            ]),
            'bank_accountable_id' => function (array $item) {
                return app($item['bank_accountable_type'])->factory();
            },
        ];
    }
}
