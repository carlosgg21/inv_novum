<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Prefix;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PrefixControllerTest extends TestCase
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
    public function it_displays_index_view_with_prefixes(): void
    {
        $prefixes = Prefix::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('prefixes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.prefixes.index')
            ->assertViewHas('prefixes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_prefix(): void
    {
        $response = $this->get(route('prefixes.create'));

        $response->assertOk()->assertViewIs('app.prefixes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_prefix(): void
    {
        $data = Prefix::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('prefixes.store'), $data);

        unset($data['position']);

        $this->assertDatabaseHas('prefixes', $data);

        $prefix = Prefix::latest('id')->first();

        $response->assertRedirect(route('prefixes.edit', $prefix));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_prefix(): void
    {
        $prefix = Prefix::factory()->create();

        $response = $this->get(route('prefixes.show', $prefix));

        $response
            ->assertOk()
            ->assertViewIs('app.prefixes.show')
            ->assertViewHas('prefix');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_prefix(): void
    {
        $prefix = Prefix::factory()->create();

        $response = $this->get(route('prefixes.edit', $prefix));

        $response
            ->assertOk()
            ->assertViewIs('app.prefixes.edit')
            ->assertViewHas('prefix');
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

        $response = $this->put(route('prefixes.update', $prefix), $data);

        unset($data['position']);

        $data['id'] = $prefix->id;

        $this->assertDatabaseHas('prefixes', $data);

        $response->assertRedirect(route('prefixes.edit', $prefix));
    }

    /**
     * @test
     */
    public function it_deletes_the_prefix(): void
    {
        $prefix = Prefix::factory()->create();

        $response = $this->delete(route('prefixes.destroy', $prefix));

        $response->assertRedirect(route('prefixes.index'));

        $this->assertSoftDeleted($prefix);
    }
}
