<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesOrderSalesOrderItemsTest extends TestCase
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
    public function it_gets_sales_order_sales_order_items(): void
    {
        $salesOrder = SalesOrder::factory()->create();
        $salesOrderItems = SalesOrderItem::factory()
            ->count(2)
            ->create([
                'sales_order_id' => $salesOrder->id,
            ]);

        $response = $this->getJson(
            route('api.sales-orders.sales-order-items.index', $salesOrder)
        );

        $response->assertOk()->assertSee($salesOrderItems[0]->notes);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_order_sales_order_items(): void
    {
        $salesOrder = SalesOrder::factory()->create();
        $data = SalesOrderItem::factory()
            ->make([
                'sales_order_id' => $salesOrder->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.sales-orders.sales-order-items.store', $salesOrder),
            $data
        );

        unset($data['sales_order_id']);

        $this->assertDatabaseHas('sales_order_items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesOrderItem = SalesOrderItem::latest('id')->first();

        $this->assertEquals($salesOrder->id, $salesOrderItem->sales_order_id);
    }
}
