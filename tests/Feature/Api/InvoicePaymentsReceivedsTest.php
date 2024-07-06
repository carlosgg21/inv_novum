<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Invoice;
use App\Models\PaymentsReceived;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvoicePaymentsReceivedsTest extends TestCase
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
    public function it_gets_invoice_payments_receiveds(): void
    {
        $invoice = Invoice::factory()->create();
        $paymentsReceiveds = PaymentsReceived::factory()
            ->count(2)
            ->create([
                'invoice_id' => $invoice->id,
            ]);

        $response = $this->getJson(
            route('api.invoices.payments-receiveds.index', $invoice)
        );

        $response->assertOk()->assertSee($paymentsReceiveds[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_invoice_payments_receiveds(): void
    {
        $invoice = Invoice::factory()->create();
        $data = PaymentsReceived::factory()
            ->make([
                'invoice_id' => $invoice->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.invoices.payments-receiveds.store', $invoice),
            $data
        );

        $this->assertDatabaseHas('payments_receiveds', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $paymentsReceived = PaymentsReceived::latest('id')->first();

        $this->assertEquals($invoice->id, $paymentsReceived->invoice_id);
    }
}
