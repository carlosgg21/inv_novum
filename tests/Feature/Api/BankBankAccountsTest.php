<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Bank;
use App\Models\BankAccount;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BankBankAccountsTest extends TestCase
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
    public function it_gets_bank_bank_accounts(): void
    {
        $bank = Bank::factory()->create();
        $bankAccounts = BankAccount::factory()
            ->count(2)
            ->create([
                'bank_id' => $bank->id,
            ]);

        $response = $this->getJson(
            route('api.banks.bank-accounts.index', $bank)
        );

        $response->assertOk()->assertSee($bankAccounts[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_bank_bank_accounts(): void
    {
        $bank = Bank::factory()->create();
        $data = BankAccount::factory()
            ->make([
                'bank_id' => $bank->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.banks.bank-accounts.store', $bank),
            $data
        );

        unset($data['bank_accountable_id']);
        unset($data['bank_accountable_type']);

        $this->assertDatabaseHas('bank_accounts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $bankAccount = BankAccount::latest('id')->first();

        $this->assertEquals($bank->id, $bankAccount->bank_id);
    }
}
