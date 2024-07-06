<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Currency;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrencyInvoicesTest extends TestCase
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
    public function it_gets_currency_invoices(): void
    {
        $currency = Currency::factory()->create();
        $invoices = Invoice::factory()
            ->count(2)
            ->create([
                'currency_id' => $currency->id,
            ]);

        $response = $this->getJson(
            route('api.currencies.invoices.index', $currency)
        );

        $response->assertOk()->assertSee($invoices[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_currency_invoices(): void
    {
        $currency = Currency::factory()->create();
        $data = Invoice::factory()
            ->make([
                'currency_id' => $currency->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.currencies.invoices.store', $currency),
            $data
        );

        $this->assertDatabaseHas('invoices', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $invoice = Invoice::latest('id')->first();

        $this->assertEquals($currency->id, $invoice->currency_id);
    }
}
