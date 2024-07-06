<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Address;
use App\Models\Township;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TownshipAddressesTest extends TestCase
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
    public function it_gets_township_addresses(): void
    {
        $township = Township::factory()->create();
        $addresses = Address::factory()
            ->count(2)
            ->create([
                'township_id' => $township->id,
            ]);

        $response = $this->getJson(
            route('api.townships.addresses.index', $township)
        );

        $response->assertOk()->assertSee($addresses[0]->address);
    }

    /**
     * @test
     */
    public function it_stores_the_township_addresses(): void
    {
        $township = Township::factory()->create();
        $data = Address::factory()
            ->make([
                'township_id' => $township->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.townships.addresses.store', $township),
            $data
        );

        $this->assertDatabaseHas('addresses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $address = Address::latest('id')->first();

        $this->assertEquals($township->id, $address->township_id);
    }
}
