<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PaymentMethod;
use App\Models\PurchaseOrder;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentMethodPurchaseOrdersTest extends TestCase
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
    public function it_gets_payment_method_purchase_orders(): void
    {
        $paymentMethod = PaymentMethod::factory()->create();
        $purchaseOrders = PurchaseOrder::factory()
            ->count(2)
            ->create([
                'payment_method_id' => $paymentMethod->id,
            ]);

        $response = $this->getJson(
            route('api.payment-methods.purchase-orders.index', $paymentMethod)
        );

        $response->assertOk()->assertSee($purchaseOrders[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_payment_method_purchase_orders(): void
    {
        $paymentMethod = PaymentMethod::factory()->create();
        $data = PurchaseOrder::factory()
            ->make([
                'payment_method_id' => $paymentMethod->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.payment-methods.purchase-orders.store', $paymentMethod),
            $data
        );

        unset($data['prefix']);

        $this->assertDatabaseHas('purchase_orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $purchaseOrder = PurchaseOrder::latest('id')->first();

        $this->assertEquals(
            $paymentMethod->id,
            $purchaseOrder->payment_method_id
        );
    }
}
