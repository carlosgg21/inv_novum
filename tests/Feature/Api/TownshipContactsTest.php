<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Contact;
use App\Models\Township;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TownshipContactsTest extends TestCase
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
    public function it_gets_township_contacts(): void
    {
        $township = Township::factory()->create();
        $contacts = Contact::factory()
            ->count(2)
            ->create([
                'township_id' => $township->id,
            ]);

        $response = $this->getJson(
            route('api.townships.contacts.index', $township)
        );

        $response->assertOk()->assertSee($contacts[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_township_contacts(): void
    {
        $township = Township::factory()->create();
        $data = Contact::factory()
            ->make([
                'township_id' => $township->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.townships.contacts.store', $township),
            $data
        );

        unset($data['contactable_id']);
        unset($data['contactable_type']);

        $this->assertDatabaseHas('contacts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $contact = Contact::latest('id')->first();

        $this->assertEquals($township->id, $contact->township_id);
    }
}
