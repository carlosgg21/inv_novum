<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Product;

use App\Models\Brand;
use App\Models\Category;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
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
    public function it_gets_products_list(): void
    {
        $products = Product::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.products.index'));

        $response->assertOk()->assertSee($products[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_product(): void
    {
        $data = Product::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.products.store'), $data);

        $this->assertDatabaseHas('products', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_product(): void
    {
        $product = Product::factory()->create();

        $category = Category::factory()->create();
        $brand = Brand::factory()->create();

        $data = [
            'code' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
            'unit' => $this->faker->text(255),
            'unit_price' => $this->faker->randomNumber(2),
            'cost_price' => $this->faker->randomNumber(2),
            'size' => $this->faker->text(255),
            'qty' => $this->faker->randomNumber(0),
            'notes' => $this->faker->text(),
            'min_qty' => $this->faker->randomNumber(0),
            'max_qty' => $this->faker->randomNumber(0),
            'on_order' => $this->faker->randomNumber(0),
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ];

        $response = $this->putJson(
            route('api.products.update', $product),
            $data
        );

        $data['id'] = $product->id;

        $this->assertDatabaseHas('products', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson(route('api.products.destroy', $product));

        $this->assertModelMissing($product);

        $response->assertNoContent();
    }
}
