<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Inventory;
use App\Models\SalesOrderItem;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InventorySalesOrderItemsTest extends TestCase
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
    public function it_gets_inventory_sales_order_items(): void
    {
        $inventory = Inventory::factory()->create();
        $salesOrderItems = SalesOrderItem::factory()
            ->count(2)
            ->create([
                'inventory_id' => $inventory->id,
            ]);

        $response = $this->getJson(
            route('api.inventories.sales-order-items.index', $inventory)
        );

        $response->assertOk()->assertSee($salesOrderItems[0]->notes);
    }

    /**
     * @test
     */
    public function it_stores_the_inventory_sales_order_items(): void
    {
        $inventory = Inventory::factory()->create();
        $data = SalesOrderItem::factory()
            ->make([
                'inventory_id' => $inventory->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.inventories.sales-order-items.store', $inventory),
            $data
        );

        unset($data['sales_order_id']);
        unset($data['inventory_id']);

        $this->assertDatabaseHas('sales_order_items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesOrderItem = SalesOrderItem::latest('id')->first();

        $this->assertEquals($inventory->id, $salesOrderItem->inventory_id);
    }
}
