<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\AppDefault;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppDefaultControllerTest extends TestCase
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
    public function it_displays_index_view_with_app_defaults(): void
    {
        $appDefaults = AppDefault::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('app-defaults.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.app_defaults.index')
            ->assertViewHas('appDefaults');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_app_default(): void
    {
        $response = $this->get(route('app-defaults.create'));

        $response->assertOk()->assertViewIs('app.app_defaults.create');
    }

    /**
     * @test
     */
    public function it_stores_the_app_default(): void
    {
        $data = AppDefault::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('app-defaults.store'), $data);

        unset($data['manager_by']);

        $this->assertDatabaseHas('app_defaults', $data);

        $appDefault = AppDefault::latest('id')->first();

        $response->assertRedirect(route('app-defaults.edit', $appDefault));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_app_default(): void
    {
        $appDefault = AppDefault::factory()->create();

        $response = $this->get(route('app-defaults.show', $appDefault));

        $response
            ->assertOk()
            ->assertViewIs('app.app_defaults.show')
            ->assertViewHas('appDefault');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_app_default(): void
    {
        $appDefault = AppDefault::factory()->create();

        $response = $this->get(route('app-defaults.edit', $appDefault));

        $response
            ->assertOk()
            ->assertViewIs('app.app_defaults.edit')
            ->assertViewHas('appDefault');
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

        $response = $this->put(
            route('app-defaults.update', $appDefault),
            $data
        );

        unset($data['manager_by']);

        $data['id'] = $appDefault->id;

        $this->assertDatabaseHas('app_defaults', $data);

        $response->assertRedirect(route('app-defaults.edit', $appDefault));
    }

    /**
     * @test
     */
    public function it_deletes_the_app_default(): void
    {
        $appDefault = AppDefault::factory()->create();

        $response = $this->delete(route('app-defaults.destroy', $appDefault));

        $response->assertRedirect(route('app-defaults.index'));

        $this->assertSoftDeleted($appDefault);
    }
}
