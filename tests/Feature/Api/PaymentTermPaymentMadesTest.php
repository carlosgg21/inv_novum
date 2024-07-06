<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PaymentTerm;
use App\Models\PaymentMade;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentTermPaymentMadesTest extends TestCase
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
    public function it_gets_payment_term_payment_mades(): void
    {
        $paymentTerm = PaymentTerm::factory()->create();
        $paymentMades = PaymentMade::factory()
            ->count(2)
            ->create([
                'payment_term_id' => $paymentTerm->id,
            ]);

        $response = $this->getJson(
            route('api.payment-terms.payment-mades.index', $paymentTerm)
        );

        $response->assertOk()->assertSee($paymentMades[0]->reference_number);
    }

    /**
     * @test
     */
    public function it_stores_the_payment_term_payment_mades(): void
    {
        $paymentTerm = PaymentTerm::factory()->create();
        $data = PaymentMade::factory()
            ->make([
                'payment_term_id' => $paymentTerm->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.payment-terms.payment-mades.store', $paymentTerm),
            $data
        );

        $this->assertDatabaseHas('payment_mades', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $paymentMade = PaymentMade::latest('id')->first();

        $this->assertEquals($paymentTerm->id, $paymentMade->payment_term_id);
    }
}
