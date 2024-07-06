<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\County;
use App\Models\Currency;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrencyCountiesTest extends TestCase
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
    public function it_gets_currency_counties(): void
    {
        $currency = Currency::factory()->create();
        $counties = County::factory()
            ->count(2)
            ->create([
                'currency_id' => $currency->id,
            ]);

        $response = $this->getJson(
            route('api.currencies.counties.index', $currency)
        );

        $response->assertOk()->assertSee($counties[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_currency_counties(): void
    {
        $currency = Currency::factory()->create();
        $data = County::factory()
            ->make([
                'currency_id' => $currency->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.currencies.counties.store', $currency),
            $data
        );

        $this->assertDatabaseHas('counties', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $county = County::latest('id')->first();

        $this->assertEquals($currency->id, $county->currency_id);
    }
}
