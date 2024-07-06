<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Condition;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConditionControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_conditions(): void
    {
        $conditions = Condition::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('conditions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.conditions.index')
            ->assertViewHas('conditions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_condition(): void
    {
        $response = $this->get(route('conditions.create'));

        $response->assertOk()->assertViewIs('app.conditions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_condition(): void
    {
        $data = Condition::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('conditions.store'), $data);

        $this->assertDatabaseHas('conditions', $data);

        $condition = Condition::latest('id')->first();

        $response->assertRedirect(route('conditions.edit', $condition));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_condition(): void
    {
        $condition = Condition::factory()->create();

        $response = $this->get(route('conditions.show', $condition));

        $response
            ->assertOk()
            ->assertViewIs('app.conditions.show')
            ->assertViewHas('condition');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_condition(): void
    {
        $condition = Condition::factory()->create();

        $response = $this->get(route('conditions.edit', $condition));

        $response
            ->assertOk()
            ->assertViewIs('app.conditions.edit')
            ->assertViewHas('condition');
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

        $response = $this->put(route('conditions.update', $condition), $data);

        $data['id'] = $condition->id;

        $this->assertDatabaseHas('conditions', $data);

        $response->assertRedirect(route('conditions.edit', $condition));
    }

    /**
     * @test
     */
    public function it_deletes_the_condition(): void
    {
        $condition = Condition::factory()->create();

        $response = $this->delete(route('conditions.destroy', $condition));

        $response->assertRedirect(route('conditions.index'));

        $this->assertModelMissing($condition);
    }
}
