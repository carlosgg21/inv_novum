<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Product;
use App\Models\Supplier;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupplierProductsTest extends TestCase
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
    public function it_gets_supplier_products(): void
    {
        $supplier = Supplier::factory()->create();
        $product = Product::factory()->create();

        $supplier->products()->attach($product);

        $response = $this->getJson(
            route('api.suppliers.products.index', $supplier)
        );

        $response->assertOk()->assertSee($product->name);
    }

    /**
     * @test
     */
    public function it_can_attach_products_to_supplier(): void
    {
        $supplier = Supplier::factory()->create();
        $product = Product::factory()->create();

        $response = $this->postJson(
            route('api.suppliers.products.store', [$supplier, $product])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $supplier
                ->products()
                ->where('products.id', $product->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_products_from_supplier(): void
    {
        $supplier = Supplier::factory()->create();
        $product = Product::factory()->create();

        $response = $this->deleteJson(
            route('api.suppliers.products.store', [$supplier, $product])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $supplier
                ->products()
                ->where('products.id', $product->id)
                ->exists()
        );
    }
}
