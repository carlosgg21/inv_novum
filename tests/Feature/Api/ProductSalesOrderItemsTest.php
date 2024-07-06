<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Product;
use App\Models\SalesOrderItem;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductSalesOrderItemsTest extends TestCase
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
    public function it_gets_product_sales_order_items(): void
    {
        $product = Product::factory()->create();
        $salesOrderItems = SalesOrderItem::factory()
            ->count(2)
            ->create([
                'product_id' => $product->id,
            ]);

        $response = $this->getJson(
            route('api.products.sales-order-items.index', $product)
        );

        $response->assertOk()->assertSee($salesOrderItems[0]->notes);
    }

    /**
     * @test
     */
    public function it_stores_the_product_sales_order_items(): void
    {
        $product = Product::factory()->create();
        $data = SalesOrderItem::factory()
            ->make([
                'product_id' => $product->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.products.sales-order-items.store', $product),
            $data
        );

        unset($data['sales_order_id']);

        $this->assertDatabaseHas('sales_order_items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesOrderItem = SalesOrderItem::latest('id')->first();

        $this->assertEquals($product->id, $salesOrderItem->product_id);
    }
}
