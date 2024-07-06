<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Product;
use App\Models\PurchaseOrderItem;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductPurchaseOrderItemsTest extends TestCase
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
    public function it_gets_product_purchase_order_items(): void
    {
        $product = Product::factory()->create();
        $purchaseOrderItems = PurchaseOrderItem::factory()
            ->count(2)
            ->create([
                'product_id' => $product->id,
            ]);

        $response = $this->getJson(
            route('api.products.purchase-order-items.index', $product)
        );

        $response->assertOk()->assertSee($purchaseOrderItems[0]->noted);
    }

    /**
     * @test
     */
    public function it_stores_the_product_purchase_order_items(): void
    {
        $product = Product::factory()->create();
        $data = PurchaseOrderItem::factory()
            ->make([
                'product_id' => $product->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.products.purchase-order-items.store', $product),
            $data
        );

        unset($data['purchase_order_id']);

        $this->assertDatabaseHas('purchase_order_items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $purchaseOrderItem = PurchaseOrderItem::latest('id')->first();

        $this->assertEquals($product->id, $purchaseOrderItem->product_id);
    }
}
