<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Township;

use App\Models\City;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TownshipTest extends TestCase
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
    public function it_gets_townships_list(): void
    {
        $townships = Township::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.townships.index'));

        $response->assertOk()->assertSee($townships[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_township(): void
    {
        $data = Township::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.townships.store'), $data);

        $this->assertDatabaseHas('townships', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_township(): void
    {
        $township = Township::factory()->create();

        $city = City::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'code' => $this->faker->text(255),
            'zip_code' => $this->faker->text(255),
            'city_id' => $city->id,
        ];

        $response = $this->putJson(
            route('api.townships.update', $township),
            $data
        );

        $data['id'] = $township->id;

        $this->assertDatabaseHas('townships', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_township(): void
    {
        $township = Township::factory()->create();

        $response = $this->deleteJson(
            route('api.townships.destroy', $township)
        );

        $this->assertSoftDeleted($township);

        $response->assertNoContent();
    }
}
