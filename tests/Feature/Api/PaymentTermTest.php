<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PaymentTerm;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentTermTest extends TestCase
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
    public function it_gets_payment_terms_list(): void
    {
        $paymentTerms = PaymentTerm::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.payment-terms.index'));

        $response->assertOk()->assertSee($paymentTerms[0]->description);
    }

    /**
     * @test
     */
    public function it_stores_the_payment_term(): void
    {
        $data = PaymentTerm::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.payment-terms.store'), $data);

        $this->assertDatabaseHas('payment_terms', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_payment_term(): void
    {
        $paymentTerm = PaymentTerm::factory()->create();

        $data = [
            'description' => $this->faker->sentence(15),
            'day' => $this->faker->randomNumber(0),
        ];

        $response = $this->putJson(
            route('api.payment-terms.update', $paymentTerm),
            $data
        );

        $data['id'] = $paymentTerm->id;

        $this->assertDatabaseHas('payment_terms', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_payment_term(): void
    {
        $paymentTerm = PaymentTerm::factory()->create();

        $response = $this->deleteJson(
            route('api.payment-terms.destroy', $paymentTerm)
        );

        $this->assertSoftDeleted($paymentTerm);

        $response->assertNoContent();
    }
}
