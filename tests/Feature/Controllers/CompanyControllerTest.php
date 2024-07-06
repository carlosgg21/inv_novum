<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Company;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyControllerTest extends TestCase
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

    protected function castToJson($json)
    {
        if (is_array($json)) {
            $json = addslashes(json_encode($json));
        } elseif (is_null($json) || is_null(json_decode($json))) {
            throw new \Exception(
                'A valid JSON string was not provided for casting.'
            );
        }

        return \DB::raw("CAST('{$json}' AS JSON)");
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_companies(): void
    {
        $companies = Company::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('companies.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.companies.index')
            ->assertViewHas('companies');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_company(): void
    {
        $response = $this->get(route('companies.create'));

        $response->assertOk()->assertViewIs('app.companies.create');
    }

    /**
     * @test
     */
    public function it_stores_the_company(): void
    {
        $data = Company::factory()
            ->make()
            ->toArray();

        $data['social_media'] = json_encode($data['social_media']);

        $response = $this->post(route('companies.store'), $data);

        $data['social_media'] = $this->castToJson($data['social_media']);

        $this->assertDatabaseHas('companies', $data);

        $company = Company::latest('id')->first();

        $response->assertRedirect(route('companies.edit', $company));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_company(): void
    {
        $company = Company::factory()->create();

        $response = $this->get(route('companies.show', $company));

        $response
            ->assertOk()
            ->assertViewIs('app.companies.show')
            ->assertViewHas('company');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_company(): void
    {
        $company = Company::factory()->create();

        $response = $this->get(route('companies.edit', $company));

        $response
            ->assertOk()
            ->assertViewIs('app.companies.edit')
            ->assertViewHas('company');
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

        $data['social_media'] = json_encode($data['social_media']);

        $response = $this->put(route('companies.update', $company), $data);

        $data['id'] = $company->id;

        $data['social_media'] = $this->castToJson($data['social_media']);

        $this->assertDatabaseHas('companies', $data);

        $response->assertRedirect(route('companies.edit', $company));
    }

    /**
     * @test
     */
    public function it_deletes_the_company(): void
    {
        $company = Company::factory()->create();

        $response = $this->delete(route('companies.destroy', $company));

        $response->assertRedirect(route('companies.index'));

        $this->assertModelMissing($company);
    }
}
