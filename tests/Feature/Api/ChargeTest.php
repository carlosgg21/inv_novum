<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Charge;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChargeTest extends TestCase
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
    public function it_gets_charges_list(): void
    {
        $charges = Charge::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.charges.index'));

        $response->assertOk()->assertSee($charges[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_charge(): void
    {
        $data = Charge::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.charges.store'), $data);

        $this->assertDatabaseHas('charges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.charges.update', $charge), $data);

        $data['id'] = $charge->id;

        $this->assertDatabaseHas('charges', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_charge(): void
    {
        $charge = Charge::factory()->create();

        $response = $this->deleteJson(route('api.charges.destroy', $charge));

        $this->assertModelMissing($charge);

        $response->assertNoContent();
    }
}
