<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PurchaseOrderPurchaseOrderItemsTest extends TestCase
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
    public function it_gets_purchase_order_purchase_order_items(): void
    {
        $purchaseOrder = PurchaseOrder::factory()->create();
        $purchaseOrderItems = PurchaseOrderItem::factory()
            ->count(2)
            ->create([
                'purchase_order_id' => $purchaseOrder->id,
            ]);

        $response = $this->getJson(
            route(
                'api.purchase-orders.purchase-order-items.index',
                $purchaseOrder
            )
        );

        $response->assertOk()->assertSee($purchaseOrderItems[0]->noted);
    }

    /**
     * @test
     */
    public function it_stores_the_purchase_order_purchase_order_items(): void
    {
        $purchaseOrder = PurchaseOrder::factory()->create();
        $data = PurchaseOrderItem::factory()
            ->make([
                'purchase_order_id' => $purchaseOrder->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.purchase-orders.purchase-order-items.store',
                $purchaseOrder
            ),
            $data
        );

        unset($data['purchase_order_id']);

        $this->assertDatabaseHas('purchase_order_items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $purchaseOrderItem = PurchaseOrderItem::latest('id')->first();

        $this->assertEquals(
            $purchaseOrder->id,
            $purchaseOrderItem->purchase_order_id
        );
    }
}
