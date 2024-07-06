<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\SalesOrder;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\PaymentTerm;
use App\Models\PaymentMethod;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesOrderControllerTest extends TestCase
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
    public function it_displays_index_view_with_sales_orders(): void
    {
        $salesOrders = SalesOrder::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sales-orders.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sales_orders.index')
            ->assertViewHas('salesOrders');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_sales_order(): void
    {
        $response = $this->get(route('sales-orders.create'));

        $response->assertOk()->assertViewIs('app.sales_orders.create');
    }

    /**
     * @test
     */
    public function it_stores_the_sales_order(): void
    {
        $data = SalesOrder::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('sales-orders.store'), $data);

        $this->assertDatabaseHas('sales_orders', $data);

        $salesOrder = SalesOrder::latest('id')->first();

        $response->assertRedirect(route('sales-orders.edit', $salesOrder));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_sales_order(): void
    {
        $salesOrder = SalesOrder::factory()->create();

        $response = $this->get(route('sales-orders.show', $salesOrder));

        $response
            ->assertOk()
            ->assertViewIs('app.sales_orders.show')
            ->assertViewHas('salesOrder');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_sales_order(): void
    {
        $salesOrder = SalesOrder::factory()->create();

        $response = $this->get(route('sales-orders.edit', $salesOrder));

        $response
            ->assertOk()
            ->assertViewIs('app.sales_orders.edit')
            ->assertViewHas('salesOrder');
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
            'miscellanues' => $this->faker->randomNumber(2),
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

        $response = $this->put(
            route('sales-orders.update', $salesOrder),
            $data
        );

        $data['id'] = $salesOrder->id;

        $this->assertDatabaseHas('sales_orders', $data);

        $response->assertRedirect(route('sales-orders.edit', $salesOrder));
    }

    /**
     * @test
     */
    public function it_deletes_the_sales_order(): void
    {
        $salesOrder = SalesOrder::factory()->create();

        $response = $this->delete(route('sales-orders.destroy', $salesOrder));

        $response->assertRedirect(route('sales-orders.index'));

        $this->assertModelMissing($salesOrder);
    }
}
