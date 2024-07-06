<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\BankAccount;

use App\Models\Bank;
use App\Models\Currency;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BankAccountTest extends TestCase
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
    public function it_gets_bank_accounts_list(): void
    {
        $bankAccounts = BankAccount::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.bank-accounts.index'));

        $response->assertOk()->assertSee($bankAccounts[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_bank_account(): void
    {
        $data = BankAccount::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.bank-accounts.store'), $data);

        unset($data['bank_accountable_id']);
        unset($data['bank_accountable_type']);

        $this->assertDatabaseHas('bank_accounts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_bank_account(): void
    {
        $bankAccount = BankAccount::factory()->create();

        $bank = Bank::factory()->create();
        $currency = Currency::factory()->create();

        $data = [
            'number' => $this->faker->text(255),
            'type' => $this->faker->word(),
            'bank_id' => $bank->id,
            'currency_id' => $currency->id,
        ];

        $response = $this->putJson(
            route('api.bank-accounts.update', $bankAccount),
            $data
        );

        unset($data['bank_accountable_id']);
        unset($data['bank_accountable_type']);

        $data['id'] = $bankAccount->id;

        $this->assertDatabaseHas('bank_accounts', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_bank_account(): void
    {
        $bankAccount = BankAccount::factory()->create();

        $response = $this->deleteJson(
            route('api.bank-accounts.destroy', $bankAccount)
        );

        $this->assertModelMissing($bankAccount);

        $response->assertNoContent();
    }
}
