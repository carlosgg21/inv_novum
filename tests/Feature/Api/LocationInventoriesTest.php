<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Location;
use App\Models\Inventory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationInventoriesTest extends TestCase
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
    public function it_gets_location_inventories(): void
    {
        $location = Location::factory()->create();
        $inventories = Inventory::factory()
            ->count(2)
            ->create([
                'location_id' => $location->id,
            ]);

        $response = $this->getJson(
            route('api.locations.inventories.index', $location)
        );

        $response->assertOk()->assertSee($inventories[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_location_inventories(): void
    {
        $location = Location::factory()->create();
        $data = Inventory::factory()
            ->make([
                'location_id' => $location->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.locations.inventories.store', $location),
            $data
        );

        $this->assertDatabaseHas('inventories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $inventory = Inventory::latest('id')->first();

        $this->assertEquals($location->id, $inventory->location_id);
    }
}
