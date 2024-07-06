<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Charge;
use App\Models\CompanyContact;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChargeCompanyContactsTest extends TestCase
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
    public function it_gets_charge_company_contacts(): void
    {
        $charge = Charge::factory()->create();
        $companyContacts = CompanyContact::factory()
            ->count(2)
            ->create([
                'charge_id' => $charge->id,
            ]);

        $response = $this->getJson(
            route('api.charges.company-contacts.index', $charge)
        );

        $response->assertOk()->assertSee($companyContacts[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_charge_company_contacts(): void
    {
        $charge = Charge::factory()->create();
        $data = CompanyContact::factory()
            ->make([
                'charge_id' => $charge->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.charges.company-contacts.store', $charge),
            $data
        );

        unset($data['company_id']);

        $this->assertDatabaseHas('company_contacts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $companyContact = CompanyContact::latest('id')->first();

        $this->assertEquals($charge->id, $companyContact->charge_id);
    }
}
