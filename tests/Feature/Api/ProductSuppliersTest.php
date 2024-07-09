<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Product;
use App\Models\Supplier;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductSuppliersTest extends TestCase
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
    public function it_gets_product_suppliers(): void
    {
        $product = Product::factory()->create();
        $supplier = Supplier::factory()->create();

        $product->suppliers()->attach($supplier);

        $response = $this->getJson(
            route('api.products.suppliers.index', $product)
        );

        $response->assertOk()->assertSee($supplier->name);
    }

    /**
     * @test
     */
    public function it_can_attach_suppliers_to_product(): void
    {
        $product = Product::factory()->create();
        $supplier = Supplier::factory()->create();

        $response = $this->postJson(
            route('api.products.suppliers.store', [$product, $supplier])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $product
                ->suppliers()
                ->where('suppliers.id', $supplier->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_suppliers_from_product(): void
    {
        $product = Product::factory()->create();
        $supplier = Supplier::factory()->create();

        $response = $this->deleteJson(
            route('api.products.suppliers.store', [$product, $supplier])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $product
                ->suppliers()
                ->where('suppliers.id', $supplier->id)
                ->exists()
        );
    }
}
