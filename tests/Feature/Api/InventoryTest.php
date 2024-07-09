<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Inventory;

use App\Models\Product;
use App\Models\Location;
use App\Models\Supplier;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InventoryTest extends TestCase
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
    public function it_gets_inventories_list(): void
    {
        $inventories = Inventory::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.inventories.index'));

        $response->assertOk()->assertSee($inventories[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_inventory(): void
    {
        $data = Inventory::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.inventories.store'), $data);

        $this->assertDatabaseHas('inventories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_inventory(): void
    {
        $inventory = Inventory::factory()->create();

        $product = Product::factory()->create();
        $location = Location::factory()->create();
        $supplier = Supplier::factory()->create();

        $data = [
            'quantity' => $this->faker->randomNumber(),
            'min_qty' => $this->faker->randomNumber(0),
            'max_qty' => $this->faker->randomNumber(0),
            'quantity_on_order' => $this->faker->randomNumber(0),
            'product_id' => $product->id,
            'location_id' => $location->id,
            'supplier_id' => $supplier->id,
        ];

        $response = $this->putJson(
            route('api.inventories.update', $inventory),
            $data
        );

        $data['id'] = $inventory->id;

        $this->assertDatabaseHas('inventories', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_inventory(): void
    {
        $inventory = Inventory::factory()->create();

        $response = $this->deleteJson(
            route('api.inventories.destroy', $inventory)
        );

        $this->assertModelMissing($inventory);

        $response->assertNoContent();
    }
}
