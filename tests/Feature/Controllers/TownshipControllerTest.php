<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Township;

use App\Models\City;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TownshipControllerTest extends TestCase
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
    public function it_displays_index_view_with_townships(): void
    {
        $townships = Township::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('townships.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.townships.index')
            ->assertViewHas('townships');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_township(): void
    {
        $response = $this->get(route('townships.create'));

        $response->assertOk()->assertViewIs('app.townships.create');
    }

    /**
     * @test
     */
    public function it_stores_the_township(): void
    {
        $data = Township::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('townships.store'), $data);

        $this->assertDatabaseHas('townships', $data);

        $township = Township::latest('id')->first();

        $response->assertRedirect(route('townships.edit', $township));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_township(): void
    {
        $township = Township::factory()->create();

        $response = $this->get(route('townships.show', $township));

        $response
            ->assertOk()
            ->assertViewIs('app.townships.show')
            ->assertViewHas('township');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_township(): void
    {
        $township = Township::factory()->create();

        $response = $this->get(route('townships.edit', $township));

        $response
            ->assertOk()
            ->assertViewIs('app.townships.edit')
            ->assertViewHas('township');
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

        $response = $this->put(route('townships.update', $township), $data);

        $data['id'] = $township->id;

        $this->assertDatabaseHas('townships', $data);

        $response->assertRedirect(route('townships.edit', $township));
    }

    /**
     * @test
     */
    public function it_deletes_the_township(): void
    {
        $township = Township::factory()->create();

        $response = $this->delete(route('townships.destroy', $township));

        $response->assertRedirect(route('townships.index'));

        $this->assertSoftDeleted($township);
    }
}
