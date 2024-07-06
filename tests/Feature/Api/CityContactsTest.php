<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\City;
use App\Models\Contact;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CityContactsTest extends TestCase
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
    public function it_gets_city_contacts(): void
    {
        $city = City::factory()->create();
        $contacts = Contact::factory()
            ->count(2)
            ->create([
                'city_id' => $city->id,
            ]);

        $response = $this->getJson(route('api.cities.contacts.index', $city));

        $response->assertOk()->assertSee($contacts[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_city_contacts(): void
    {
        $city = City::factory()->create();
        $data = Contact::factory()
            ->make([
                'city_id' => $city->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.cities.contacts.store', $city),
            $data
        );

        unset($data['contactable_id']);
        unset($data['contactable_type']);

        $this->assertDatabaseHas('contacts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $contact = Contact::latest('id')->first();

        $this->assertEquals($city->id, $contact->city_id);
    }
}
