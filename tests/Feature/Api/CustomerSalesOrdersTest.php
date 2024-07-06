<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Customer;
use App\Models\SalesOrder;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerSalesOrdersTest extends TestCase
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
    public function it_gets_customer_sales_orders(): void
    {
        $customer = Customer::factory()->create();
        $salesOrders = SalesOrder::factory()
            ->count(2)
            ->create([
                'customer_id' => $customer->id,
            ]);

        $response = $this->getJson(
            route('api.customers.sales-orders.index', $customer)
        );

        $response->assertOk()->assertSee($salesOrders[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_customer_sales_orders(): void
    {
        $customer = Customer::factory()->create();
        $data = SalesOrder::factory()
            ->make([
                'customer_id' => $customer->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.customers.sales-orders.store', $customer),
            $data
        );

        $this->assertDatabaseHas('sales_orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesOrder = SalesOrder::latest('id')->first();

        $this->assertEquals($customer->id, $salesOrder->customer_id);
    }
}
