<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Charge;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChargeControllerTest extends TestCase
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
    public function it_displays_index_view_with_charges(): void
    {
        $charges = Charge::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('charges.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.charges.index')
            ->assertViewHas('charges');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_charge(): void
    {
        $response = $this->get(route('charges.create'));

        $response->assertOk()->assertViewIs('app.charges.create');
    }

    /**
     * @test
     */
    public function it_stores_the_charge(): void
    {
        $data = Charge::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('charges.store'), $data);

        $this->assertDatabaseHas('charges', $data);

        $charge = Charge::latest('id')->first();

        $response->assertRedirect(route('charges.edit', $charge));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_charge(): void
    {
        $charge = Charge::factory()->create();

        $response = $this->get(route('charges.show', $charge));

        $response
            ->assertOk()
            ->assertViewIs('app.charges.show')
            ->assertViewHas('charge');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_charge(): void
    {
        $charge = Charge::factory()->create();

        $response = $this->get(route('charges.edit', $charge));

        $response
            ->assertOk()
            ->assertViewIs('app.charges.edit')
            ->assertViewHas('charge');
    }

    /**
     * @test
     */
    public function it_updates_the_charge(): void
    {
        $charge = Charge::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
        ];

        $response = $this->put(route('charges.update', $charge), $data);

        $data['id'] = $charge->id;

        $this->assertDatabaseHas('charges', $data);

        $response->assertRedirect(route('charges.edit', $charge));
    }

    /**
     * @test
     */
    public function it_deletes_the_charge(): void
    {
        $charge = Charge::factory()->create();

        $response = $this->delete(route('charges.destroy', $charge));

        $response->assertRedirect(route('charges.index'));

        $this->assertModelMissing($charge);
    }
}
