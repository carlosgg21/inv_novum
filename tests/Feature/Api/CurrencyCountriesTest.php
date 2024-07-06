<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Country;
use App\Models\Currency;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrencyCountriesTest extends TestCase
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
    public function it_gets_currency_countries(): void
    {
        $currency = Currency::factory()->create();
        $countries = Country::factory()
            ->count(2)
            ->create([
                'currency_id' => $currency->id,
            ]);

        $response = $this->getJson(
            route('api.currencies.countries.index', $currency)
        );

        $response->assertOk()->assertSee($countries[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_currency_countries(): void
    {
        $currency = Currency::factory()->create();
        $data = Country::factory()
            ->make([
                'currency_id' => $currency->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.currencies.countries.store', $currency),
            $data
        );

        $this->assertDatabaseHas('countries', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $country = Country::latest('id')->first();

        $this->assertEquals($currency->id, $country->currency_id);
    }
}
