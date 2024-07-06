<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PaymentMade;
use App\Models\PurchaseOrder;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PurchaseOrderPaymentMadesTest extends TestCase
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
    public function it_gets_purchase_order_payment_mades(): void
    {
        $purchaseOrder = PurchaseOrder::factory()->create();
        $paymentMades = PaymentMade::factory()
            ->count(2)
            ->create([
                'purchase_order_id' => $purchaseOrder->id,
            ]);

        $response = $this->getJson(
            route('api.purchase-orders.payment-mades.index', $purchaseOrder)
        );

        $response->assertOk()->assertSee($paymentMades[0]->reference_number);
    }

    /**
     * @test
     */
    public function it_stores_the_purchase_order_payment_mades(): void
    {
        $purchaseOrder = PurchaseOrder::factory()->create();
        $data = PaymentMade::factory()
            ->make([
                'purchase_order_id' => $purchaseOrder->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.purchase-orders.payment-mades.store', $purchaseOrder),
            $data
        );

        $this->assertDatabaseHas('payment_mades', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $paymentMade = PaymentMade::latest('id')->first();

        $this->assertEquals(
            $purchaseOrder->id,
            $paymentMade->purchase_order_id
        );
    }
}
