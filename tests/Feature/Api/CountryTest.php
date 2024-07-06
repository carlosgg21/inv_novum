<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Country;

use App\Models\Currency;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryTest extends TestCase
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
    public function it_gets_countries_list(): void
    {
        $countries = Country::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.countries.index'));

        $response->assertOk()->assertSee($countries[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_country(): void
    {
        $data = Country::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.countries.store'), $data);

        $this->assertDatabaseHas('countries', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_country(): void
    {
        $country = Country::factory()->create();

        $currency = Currency::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'code' => $this->faker->text(255),
            'iso' => $this->faker->text(255),
            'time_zone' => $this->faker->text(255),
            'flag' => $this->faker->text(255),
            'currency_id' => $currency->id,
        ];

        $response = $this->putJson(
            route('api.countries.update', $country),
            $data
        );

        $data['id'] = $country->id;

        $this->assertDatabaseHas('countries', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_country(): void
    {
        $country = Country::factory()->create();

        $response = $this->deleteJson(route('api.countries.destroy', $country));

        $this->assertSoftDeleted($country);

        $response->assertNoContent();
    }
}
