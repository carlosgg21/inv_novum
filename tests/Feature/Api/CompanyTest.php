<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Company;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
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
    public function it_gets_companies_list(): void
    {
        $companies = Company::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.companies.index'));

        $response->assertOk()->assertSee($companies[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_company(): void
    {
        $data = Company::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.companies.store'), $data);

        $this->assertDatabaseHas('companies', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_company(): void
    {
        $company = Company::factory()->create();

        $data = [
            'code' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'acronym' => $this->faker->text(255),
            'logo' => $this->faker->text(255),
            'slogan' => $this->faker->text(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'web_site' => $this->faker->text(255),
            'social_media' => [],
            'address' => $this->faker->text(),
            'qr_code' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.companies.update', $company),
            $data
        );

        $data['id'] = $company->id;

        $this->assertDatabaseHas('companies', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_company(): void
    {
        $company = Company::factory()->create();

        $response = $this->deleteJson(route('api.companies.destroy', $company));

        $this->assertModelMissing($company);

        $response->assertNoContent();
    }
}
