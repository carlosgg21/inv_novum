<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Country;
use App\Models\Address;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryAddressesTest extends TestCase
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
    public function it_gets_country_addresses(): void
    {
        $country = Country::factory()->create();
        $addresses = Address::factory()
            ->count(2)
            ->create([
                'country_id' => $country->id,
            ]);

        $response = $this->getJson(
            route('api.countries.addresses.index', $country)
        );

        $response->assertOk()->assertSee($addresses[0]->address);
    }

    /**
     * @test
     */
    public function it_stores_the_country_addresses(): void
    {
        $country = Country::factory()->create();
        $data = Address::factory()
            ->make([
                'country_id' => $country->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.countries.addresses.store', $country),
            $data
        );

        $this->assertDatabaseHas('addresses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $address = Address::latest('id')->first();

        $this->assertEquals($country->id, $address->country_id);
    }
}
