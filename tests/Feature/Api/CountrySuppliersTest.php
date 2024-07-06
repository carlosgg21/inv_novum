<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Country;
use App\Models\Supplier;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountrySuppliersTest extends TestCase
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
    public function it_gets_country_suppliers(): void
    {
        $country = Country::factory()->create();
        $suppliers = Supplier::factory()
            ->count(2)
            ->create([
                'country_id' => $country->id,
            ]);

        $response = $this->getJson(
            route('api.countries.suppliers.index', $country)
        );

        $response->assertOk()->assertSee($suppliers[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_country_suppliers(): void
    {
        $country = Country::factory()->create();
        $data = Supplier::factory()
            ->make([
                'country_id' => $country->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.countries.suppliers.store', $country),
            $data
        );

        $this->assertDatabaseHas('suppliers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $supplier = Supplier::latest('id')->first();

        $this->assertEquals($country->id, $supplier->country_id);
    }
}
