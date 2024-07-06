<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PaymentMethod;
use App\Models\PaymentsReceived;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentMethodPaymentsReceivedsTest extends TestCase
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
    public function it_gets_payment_method_payments_receiveds(): void
    {
        $paymentMethod = PaymentMethod::factory()->create();
        $paymentsReceiveds = PaymentsReceived::factory()
            ->count(2)
            ->create([
                'payment_method_id' => $paymentMethod->id,
            ]);

        $response = $this->getJson(
            route(
                'api.payment-methods.payments-receiveds.index',
                $paymentMethod
            )
        );

        $response->assertOk()->assertSee($paymentsReceiveds[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_payment_method_payments_receiveds(): void
    {
        $paymentMethod = PaymentMethod::factory()->create();
        $data = PaymentsReceived::factory()
            ->make([
                'payment_method_id' => $paymentMethod->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.payment-methods.payments-receiveds.store',
                $paymentMethod
            ),
            $data
        );

        $this->assertDatabaseHas('payments_receiveds', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $paymentsReceived = PaymentsReceived::latest('id')->first();

        $this->assertEquals(
            $paymentMethod->id,
            $paymentsReceived->payment_method_id
        );
    }
}
