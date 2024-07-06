<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\BankAccount;

use App\Models\Bank;
use App\Models\Currency;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BankAccountControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_bank_accounts(): void
    {
        $bankAccounts = BankAccount::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('bank-accounts.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.bank_accounts.index')
            ->assertViewHas('bankAccounts');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_bank_account(): void
    {
        $response = $this->get(route('bank-accounts.create'));

        $response->assertOk()->assertViewIs('app.bank_accounts.create');
    }

    /**
     * @test
     */
    public function it_stores_the_bank_account(): void
    {
        $data = BankAccount::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('bank-accounts.store'), $data);

        unset($data['bank_accountable_id']);
        unset($data['bank_accountable_type']);

        $this->assertDatabaseHas('bank_accounts', $data);

        $bankAccount = BankAccount::latest('id')->first();

        $response->assertRedirect(route('bank-accounts.edit', $bankAccount));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_bank_account(): void
    {
        $bankAccount = BankAccount::factory()->create();

        $response = $this->get(route('bank-accounts.show', $bankAccount));

        $response
            ->assertOk()
            ->assertViewIs('app.bank_accounts.show')
            ->assertViewHas('bankAccount');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_bank_account(): void
    {
        $bankAccount = BankAccount::factory()->create();

        $response = $this->get(route('bank-accounts.edit', $bankAccount));

        $response
            ->assertOk()
            ->assertViewIs('app.bank_accounts.edit')
            ->assertViewHas('bankAccount');
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

        $response = $this->put(
            route('bank-accounts.update', $bankAccount),
            $data
        );

        unset($data['bank_accountable_id']);
        unset($data['bank_accountable_type']);

        $data['id'] = $bankAccount->id;

        $this->assertDatabaseHas('bank_accounts', $data);

        $response->assertRedirect(route('bank-accounts.edit', $bankAccount));
    }

    /**
     * @test
     */
    public function it_deletes_the_bank_account(): void
    {
        $bankAccount = BankAccount::factory()->create();

        $response = $this->delete(route('bank-accounts.destroy', $bankAccount));

        $response->assertRedirect(route('bank-accounts.index'));

        $this->assertModelMissing($bankAccount);
    }
}
