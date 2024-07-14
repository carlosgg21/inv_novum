<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Prefix;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PrefixTest extends TestCase
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
    public function it_gets_prefixes_list(): void
    {
        $prefixes = Prefix::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.prefixes.index'));

        $response->assertOk()->assertSee($prefixes[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_prefix(): void
    {
        $data = Prefix::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.prefixes.store'), $data);

        unset($data['position']);

        $this->assertDatabaseHas('prefixes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_prefix(): void
    {
        $prefix = Prefix::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'display' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'used_in' => 'invoice',
            'star_number' => $this->faker->randomNumber(0),
            'position' => $this->faker->randomNumber(0),
        ];

        $response = $this->putJson(
            route('api.prefixes.update', $prefix),
            $data
        );

        unset($data['position']);

        $data['id'] = $prefix->id;

        $this->assertDatabaseHas('prefixes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_prefix(): void
    {
        $prefix = Prefix::factory()->create();

        $response = $this->deleteJson(route('api.prefixes.destroy', $prefix));

        $this->assertSoftDeleted($prefix);

        $response->assertNoContent();
    }
}
