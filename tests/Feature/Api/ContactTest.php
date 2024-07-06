<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Contact;

use App\Models\City;
use App\Models\Country;
use App\Models\Township;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
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
    public function it_gets_contacts_list(): void
    {
        $contacts = Contact::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.contacts.index'));

        $response->assertOk()->assertSee($contacts[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_contact(): void
    {
        $data = Contact::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.contacts.store'), $data);

        unset($data['contactable_id']);
        unset($data['contactable_type']);

        $this->assertDatabaseHas('contacts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_contact(): void
    {
        $contact = Contact::factory()->create();

        $township = Township::factory()->create();
        $city = City::factory()->create();
        $country = Country::factory()->create();

        $data = [
            'identication' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'last_name' => $this->faker->lastName(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'address' => $this->faker->text(),
            'township_id' => $township->id,
            'city_id' => $city->id,
            'country_id' => $country->id,
        ];

        $response = $this->putJson(
            route('api.contacts.update', $contact),
            $data
        );

        unset($data['contactable_id']);
        unset($data['contactable_type']);

        $data['id'] = $contact->id;

        $this->assertDatabaseHas('contacts', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_contact(): void
    {
        $contact = Contact::factory()->create();

        $response = $this->deleteJson(route('api.contacts.destroy', $contact));

        $this->assertModelMissing($contact);

        $response->assertNoContent();
    }
}
