<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\City;
use App\Models\Township;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CityTownshipsTest extends TestCase
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
    public function it_gets_city_townships(): void
    {
        $city = City::factory()->create();
        $townships = Township::factory()
            ->count(2)
            ->create([
                'city_id' => $city->id,
            ]);

        $response = $this->getJson(route('api.cities.townships.index', $city));

        $response->assertOk()->assertSee($townships[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_city_townships(): void
    {
        $city = City::factory()->create();
        $data = Township::factory()
            ->make([
                'city_id' => $city->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.cities.townships.store', $city),
            $data
        );

        $this->assertDatabaseHas('townships', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $township = Township::latest('id')->first();

        $this->assertEquals($city->id, $township->city_id);
    }
}
