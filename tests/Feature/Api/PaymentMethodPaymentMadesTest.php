<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PaymentMade;
use App\Models\PaymentMethod;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentMethodPaymentMadesTest extends TestCase
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
    public function it_gets_payment_method_payment_mades(): void
    {
        $paymentMethod = PaymentMethod::factory()->create();
        $paymentMades = PaymentMade::factory()
            ->count(2)
            ->create([
                'payment_method_id' => $paymentMethod->id,
            ]);

        $response = $this->getJson(
            route('api.payment-methods.payment-mades.index', $paymentMethod)
        );

        $response->assertOk()->assertSee($paymentMades[0]->reference_number);
    }

    /**
     * @test
     */
    public function it_stores_the_payment_method_payment_mades(): void
    {
        $paymentMethod = PaymentMethod::factory()->create();
        $data = PaymentMade::factory()
            ->make([
                'payment_method_id' => $paymentMethod->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.payment-methods.payment-mades.store', $paymentMethod),
            $data
        );

        $this->assertDatabaseHas('payment_mades', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $paymentMade = PaymentMade::latest('id')->first();

        $this->assertEquals(
            $paymentMethod->id,
            $paymentMade->payment_method_id
        );
    }
}
