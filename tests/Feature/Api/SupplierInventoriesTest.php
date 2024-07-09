<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Supplier;
use App\Models\Inventory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupplierInventoriesTest extends TestCase
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
    public function it_gets_supplier_inventories(): void
    {
        $supplier = Supplier::factory()->create();
        $inventories = Inventory::factory()
            ->count(2)
            ->create([
                'supplier_id' => $supplier->id,
            ]);

        $response = $this->getJson(
            route('api.suppliers.inventories.index', $supplier)
        );

        $response->assertOk()->assertSee($inventories[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_supplier_inventories(): void
    {
        $supplier = Supplier::factory()->create();
        $data = Inventory::factory()
            ->make([
                'supplier_id' => $supplier->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.suppliers.inventories.store', $supplier),
            $data
        );

        $this->assertDatabaseHas('inventories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $inventory = Inventory::latest('id')->first();

        $this->assertEquals($supplier->id, $inventory->supplier_id);
    }
}
