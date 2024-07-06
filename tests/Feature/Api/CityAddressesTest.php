<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\City;
use App\Models\Address;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CityAddressesTest extends TestCase
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
    public function it_gets_city_addresses(): void
    {
        $city = City::factory()->create();
        $addresses = Address::factory()
            ->count(2)
            ->create([
                'city_id' => $city->id,
            ]);

        $response = $this->getJson(route('api.cities.addresses.index', $city));

        $response->assertOk()->assertSee($addresses[0]->address);
    }

    /**
     * @test
     */
    public function it_stores_the_city_addresses(): void
    {
        $city = City::factory()->create();
        $data = Address::factory()
            ->make([
                'city_id' => $city->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.cities.addresses.store', $city),
            $data
        );

        $this->assertDatabaseHas('addresses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $address = Address::latest('id')->first();

        $this->assertEquals($city->id, $address->city_id);
    }
}
