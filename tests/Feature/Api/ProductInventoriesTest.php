<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Product;
use App\Models\Inventory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductInventoriesTest extends TestCase
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
    public function it_gets_product_inventories(): void
    {
        $product = Product::factory()->create();
        $inventories = Inventory::factory()
            ->count(2)
            ->create([
                'product_id' => $product->id,
            ]);

        $response = $this->getJson(
            route('api.products.inventories.index', $product)
        );

        $response->assertOk()->assertSee($inventories[0]->batch_number);
    }

    /**
     * @test
     */
    public function it_stores_the_product_inventories(): void
    {
        $product = Product::factory()->create();
        $data = Inventory::factory()
            ->make([
                'product_id' => $product->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.products.inventories.store', $product),
            $data
        );

        $this->assertDatabaseHas('inventories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $inventory = Inventory::latest('id')->first();

        $this->assertEquals($product->id, $inventory->product_id);
    }
}
