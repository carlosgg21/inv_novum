<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Inventory;
use App\Models\PurchaseOrderItem;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InventoryPurchaseOrderItemsTest extends TestCase
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
    public function it_gets_inventory_purchase_order_items(): void
    {
        $inventory = Inventory::factory()->create();
        $purchaseOrderItems = PurchaseOrderItem::factory()
            ->count(2)
            ->create([
                'inventory_id' => $inventory->id,
            ]);

        $response = $this->getJson(
            route('api.inventories.purchase-order-items.index', $inventory)
        );

        $response->assertOk()->assertSee($purchaseOrderItems[0]->noted);
    }

    /**
     * @test
     */
    public function it_stores_the_inventory_purchase_order_items(): void
    {
        $inventory = Inventory::factory()->create();
        $data = PurchaseOrderItem::factory()
            ->make([
                'inventory_id' => $inventory->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.inventories.purchase-order-items.store', $inventory),
            $data
        );

        unset($data['purchase_order_id']);
        unset($data['inventory_id']);

        $this->assertDatabaseHas('purchase_order_items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $purchaseOrderItem = PurchaseOrderItem::latest('id')->first();

        $this->assertEquals($inventory->id, $purchaseOrderItem->inventory_id);
    }
}
