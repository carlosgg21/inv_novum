<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Country;
use App\Models\Contact;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryContactsTest extends TestCase
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
    public function it_gets_country_contacts(): void
    {
        $country = Country::factory()->create();
        $contacts = Contact::factory()
            ->count(2)
            ->create([
                'country_id' => $country->id,
            ]);

        $response = $this->getJson(
            route('api.countries.contacts.index', $country)
        );

        $response->assertOk()->assertSee($contacts[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_country_contacts(): void
    {
        $country = Country::factory()->create();
        $data = Contact::factory()
            ->make([
                'country_id' => $country->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.countries.contacts.store', $country),
            $data
        );

        unset($data['contactable_id']);
        unset($data['contactable_type']);

        $this->assertDatabaseHas('contacts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $contact = Contact::latest('id')->first();

        $this->assertEquals($country->id, $contact->country_id);
    }
}
