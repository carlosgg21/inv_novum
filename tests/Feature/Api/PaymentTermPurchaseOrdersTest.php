<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PaymentTerm;
use App\Models\PurchaseOrder;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentTermPurchaseOrdersTest extends TestCase
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
    public function it_gets_payment_term_purchase_orders(): void
    {
        $paymentTerm = PaymentTerm::factory()->create();
        $purchaseOrders = PurchaseOrder::factory()
            ->count(2)
            ->create([
                'payment_term_id' => $paymentTerm->id,
            ]);

        $response = $this->getJson(
            route('api.payment-terms.purchase-orders.index', $paymentTerm)
        );

        $response->assertOk()->assertSee($purchaseOrders[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_payment_term_purchase_orders(): void
    {
        $paymentTerm = PaymentTerm::factory()->create();
        $data = PurchaseOrder::factory()
            ->make([
                'payment_term_id' => $paymentTerm->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.payment-terms.purchase-orders.store', $paymentTerm),
            $data
        );

        unset($data['prefix']);

        $this->assertDatabaseHas('purchase_orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $purchaseOrder = PurchaseOrder::latest('id')->first();

        $this->assertEquals($paymentTerm->id, $purchaseOrder->payment_term_id);
    }
}
