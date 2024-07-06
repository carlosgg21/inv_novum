<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PaymentTerm;
use App\Models\PaymentsReceived;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentTermPaymentsReceivedsTest extends TestCase
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
    public function it_gets_payment_term_payments_receiveds(): void
    {
        $paymentTerm = PaymentTerm::factory()->create();
        $paymentsReceiveds = PaymentsReceived::factory()
            ->count(2)
            ->create([
                'payment_term_id' => $paymentTerm->id,
            ]);

        $response = $this->getJson(
            route('api.payment-terms.payments-receiveds.index', $paymentTerm)
        );

        $response->assertOk()->assertSee($paymentsReceiveds[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_payment_term_payments_receiveds(): void
    {
        $paymentTerm = PaymentTerm::factory()->create();
        $data = PaymentsReceived::factory()
            ->make([
                'payment_term_id' => $paymentTerm->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.payment-terms.payments-receiveds.store', $paymentTerm),
            $data
        );

        $this->assertDatabaseHas('payments_receiveds', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $paymentsReceived = PaymentsReceived::latest('id')->first();

        $this->assertEquals(
            $paymentTerm->id,
            $paymentsReceived->payment_term_id
        );
    }
}
