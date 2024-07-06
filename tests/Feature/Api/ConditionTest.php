<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Condition;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConditionTest extends TestCase
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
    public function it_gets_conditions_list(): void
    {
        $conditions = Condition::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.conditions.index'));

        $response->assertOk()->assertSee($conditions[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_condition(): void
    {
        $data = Condition::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.conditions.store'), $data);

        $this->assertDatabaseHas('conditions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_condition(): void
    {
        $condition = Condition::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
        ];

        $response = $this->putJson(
            route('api.conditions.update', $condition),
            $data
        );

        $data['id'] = $condition->id;

        $this->assertDatabaseHas('conditions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_condition(): void
    {
        $condition = Condition::factory()->create();

        $response = $this->deleteJson(
            route('api.conditions.destroy', $condition)
        );

        $this->assertModelMissing($condition);

        $response->assertNoContent();
    }
}
