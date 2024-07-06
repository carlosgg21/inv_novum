<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Currency;
use App\Models\BankAccount;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrencyBankAccountsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_currency_bank_accounts(): void
    {
        $currency = Currency::factory()->create();
        $bankAccounts = BankAccount::factory()
            ->count(2)
            ->create([
                'currency_id' => $currency->id,
            ]);

        $response = $this->getJson(
            route('api.currencies.bank-accounts.index', $currency)
        );

        $response->assertOk()->assertSee($bankAccounts[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_currency_bank_accounts(): void
    {
        $currency = Currency::factory()->create();
        $data = BankAccount::factory()
            ->make([
                'currency_id' => $currency->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.currencies.bank-accounts.store', $currency),
            $data
        );

        unset($data['bank_accountable_id']);
        unset($data['bank_accountable_type']);

        $this->assertDatabaseHas('bank_accounts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $bankAccount = BankAccount::latest('id')->first();

        $this->assertEquals($currency->id, $bankAccount->currency_id);
    }
}
