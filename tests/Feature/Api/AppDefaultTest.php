<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AppDefault;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppDefaultTest extends TestCase
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
    public function it_gets_app_defaults_list(): void
    {
        $appDefaults = AppDefault::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.app-defaults.index'));

        $response->assertOk()->assertSee($appDefaults[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_app_default(): void
    {
        $data = AppDefault::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.app-defaults.store'), $data);

        unset($data['manager_by']);

        $this->assertDatabaseHas('app_defaults', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_app_default(): void
    {
        $appDefault = AppDefault::factory()->create();

        $data = [
            'module' => $this->faker->text(),
            'name' => $this->faker->name(),
            'display_name' => $this->faker->text(255),
            'value' => $this->faker->text(),
            'description' => $this->faker->sentence(15),
            'manager_by' => $this->faker->boolean(),
        ];

        $response = $this->putJson(
            route('api.app-defaults.update', $appDefault),
            $data
        );

        unset($data['manager_by']);

        $data['id'] = $appDefault->id;

        $this->assertDatabaseHas('app_defaults', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_app_default(): void
    {
        $appDefault = AppDefault::factory()->create();

        $response = $this->deleteJson(
            route('api.app-defaults.destroy', $appDefault)
        );

        $this->assertSoftDeleted($appDefault);

        $response->assertNoContent();
    }
}
