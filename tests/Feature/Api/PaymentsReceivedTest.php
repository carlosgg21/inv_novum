<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PaymentsReceived;

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\SalesOrder;
use App\Models\PaymentTerm;
use App\Models\PaymentMethod;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentsReceivedTest extends TestCase
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
    public function it_gets_payments_receiveds_list(): void
    {
        $paymentsReceiveds = PaymentsReceived::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.payments-receiveds.index'));

        $response->assertOk()->assertSee($paymentsReceiveds[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_payments_received(): void
    {
        $data = PaymentsReceived::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.payments-receiveds.store'),
            $data
        );

        $this->assertDatabaseHas('payments_receiveds', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_payments_received(): void
    {
        $paymentsReceived = PaymentsReceived::factory()->create();

        $paymentMethod = PaymentMethod::factory()->create();
        $paymentTerm = PaymentTerm::factory()->create();
        $invoice = Invoice::factory()->create();
        $salesOrder = SalesOrder::factory()->create();
        $customer = Customer::factory()->create();
        $employee = Employee::factory()->create();

        $data = [
            'amount' => $this->faker->randomNumber(2),
            'date' => $this->faker->date(),
            'notes' => $this->faker->text(),
            'payment_method_id' => $paymentMethod->id,
            'payment_term_id' => $paymentTerm->id,
            'invoice_id' => $invoice->id,
            'sales_order_id' => $salesOrder->id,
            'customer_id' => $customer->id,
            'received_id' => $employee->id,
        ];

        $response = $this->putJson(
            route('api.payments-receiveds.update', $paymentsReceived),
            $data
        );

        $data['id'] = $paymentsReceived->id;

        $this->assertDatabaseHas('payments_receiveds', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_payments_received(): void
    {
        $paymentsReceived = PaymentsReceived::factory()->create();

        $response = $this->deleteJson(
            route('api.payments-receiveds.destroy', $paymentsReceived)
        );

        $this->assertSoftDeleted($paymentsReceived);

        $response->assertNoContent();
    }
}
