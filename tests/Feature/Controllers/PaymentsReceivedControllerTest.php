<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\PaymentsReceived;

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\SalesOrder;
use App\Models\PaymentTerm;
use App\Models\PaymentMethod;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentsReceivedControllerTest extends TestCase
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
    public function it_displays_index_view_with_payments_receiveds(): void
    {
        $paymentsReceiveds = PaymentsReceived::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('payments-receiveds.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.payments_receiveds.index')
            ->assertViewHas('paymentsReceiveds');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_payments_received(): void
    {
        $response = $this->get(route('payments-receiveds.create'));

        $response->assertOk()->assertViewIs('app.payments_receiveds.create');
    }

    /**
     * @test
     */
    public function it_stores_the_payments_received(): void
    {
        $data = PaymentsReceived::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('payments-receiveds.store'), $data);

        $this->assertDatabaseHas('payments_receiveds', $data);

        $paymentsReceived = PaymentsReceived::latest('id')->first();

        $response->assertRedirect(
            route('payments-receiveds.edit', $paymentsReceived)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_payments_received(): void
    {
        $paymentsReceived = PaymentsReceived::factory()->create();

        $response = $this->get(
            route('payments-receiveds.show', $paymentsReceived)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.payments_receiveds.show')
            ->assertViewHas('paymentsReceived');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_payments_received(): void
    {
        $paymentsReceived = PaymentsReceived::factory()->create();

        $response = $this->get(
            route('payments-receiveds.edit', $paymentsReceived)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.payments_receiveds.edit')
            ->assertViewHas('paymentsReceived');
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

        $response = $this->put(
            route('payments-receiveds.update', $paymentsReceived),
            $data
        );

        $data['id'] = $paymentsReceived->id;

        $this->assertDatabaseHas('payments_receiveds', $data);

        $response->assertRedirect(
            route('payments-receiveds.edit', $paymentsReceived)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_payments_received(): void
    {
        $paymentsReceived = PaymentsReceived::factory()->create();

        $response = $this->delete(
            route('payments-receiveds.destroy', $paymentsReceived)
        );

        $response->assertRedirect(route('payments-receiveds.index'));

        $this->assertSoftDeleted($paymentsReceived);
    }
}
