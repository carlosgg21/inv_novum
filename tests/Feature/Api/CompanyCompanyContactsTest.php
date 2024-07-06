<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Company;
use App\Models\CompanyContact;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyCompanyContactsTest extends TestCase
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
    public function it_gets_company_company_contacts(): void
    {
        $company = Company::factory()->create();
        $companyContacts = CompanyContact::factory()
            ->count(2)
            ->create([
                'company_id' => $company->id,
            ]);

        $response = $this->getJson(
            route('api.companies.company-contacts.index', $company)
        );

        $response->assertOk()->assertSee($companyContacts[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_company_company_contacts(): void
    {
        $company = Company::factory()->create();
        $data = CompanyContact::factory()
            ->make([
                'company_id' => $company->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.companies.company-contacts.store', $company),
            $data
        );

        unset($data['company_id']);

        $this->assertDatabaseHas('company_contacts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $companyContact = CompanyContact::latest('id')->first();

        $this->assertEquals($company->id, $companyContact->company_id);
    }
}
