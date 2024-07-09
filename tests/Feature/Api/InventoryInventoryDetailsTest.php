<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Inventory;
use App\Models\InventoryDetail;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InventoryInventoryDetailsTest extends TestCase
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
    public function it_gets_inventory_inventory_details(): void
    {
        $inventory = Inventory::factory()->create();
        $inventoryDetails = InventoryDetail::factory()
            ->count(2)
            ->create([
                'inventory_id' => $inventory->id,
            ]);

        $response = $this->getJson(
            route('api.inventories.inventory-details.index', $inventory)
        );

        $response->assertOk()->assertSee($inventoryDetails[0]->batch_number);
    }

    /**
     * @test
     */
    public function it_stores_the_inventory_inventory_details(): void
    {
        $inventory = Inventory::factory()->create();
        $data = InventoryDetail::factory()
            ->make([
                'inventory_id' => $inventory->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.inventories.inventory-details.store', $inventory),
            $data
        );

        unset($data['inventory_id']);

        $this->assertDatabaseHas('inventory_details', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $inventoryDetail = InventoryDetail::latest('id')->first();

        $this->assertEquals($inventory->id, $inventoryDetail->inventory_id);
    }
}
