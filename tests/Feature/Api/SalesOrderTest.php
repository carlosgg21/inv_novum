<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesOrder;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\PaymentTerm;
use App\Models\PaymentMethod;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesOrderTest extends TestCase
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
    public function it_gets_sales_orders_list(): void
    {
        $salesOrders = SalesOrder::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.sales-orders.index'));

        $response->assertOk()->assertSee($salesOrders[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_order(): void
    {
        $data = SalesOrder::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.sales-orders.store'), $data);

        $this->assertDatabaseHas('sales_orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_sales_order(): void
    {
        $salesOrder = SalesOrder::factory()->create();

        $customer = Customer::factory()->create();
        $paymentMethod = PaymentMethod::factory()->create();
        $paymentTerm = PaymentTerm::factory()->create();
        $employee = Employee::factory()->create();

        $data = [
            'number' => $this->faker->text(255),
            'prefix' => $this->faker->text(255),
            'order_date' => $this->faker->date(),
            'invoice_date' => $this->faker->date(),
            'status' => 'not entered',
            'taxes' => $this->faker->randomNumber(2),
            'discount' => $this->faker->randomNumber(2),
            'miscellaneous' => $this->faker->randomNumber(2),
            'freight' => $this->faker->randomNumber(2),
            'order_total' => $this->faker->randomNumber(2),
            'notes' => $this->faker->text(),
            'internal_notes' => $this->faker->text(),
            'approved_by' => $this->faker->text(255),
            'customer_id' => $customer->id,
            'payment_method_id' => $paymentMethod->id,
            'payment_term_id' => $paymentTerm->id,
            'sold_by' => $employee->id,
        ];

        $response = $this->putJson(
            route('api.sales-orders.update', $salesOrder),
            $data
        );

        $data['id'] = $salesOrder->id;

        $this->assertDatabaseHas('sales_orders', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_sales_order(): void
    {
        $salesOrder = SalesOrder::factory()->create();

        $response = $this->deleteJson(
            route('api.sales-orders.destroy', $salesOrder)
        );

        $this->assertModelMissing($salesOrder);

        $response->assertNoContent();
    }
}
