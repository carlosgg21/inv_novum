<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesOrder;
use App\Models\PaymentMethod;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentMethodSalesOrdersTest extends TestCase
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
    public function it_gets_payment_method_sales_orders(): void
    {
        $paymentMethod = PaymentMethod::factory()->create();
        $salesOrders = SalesOrder::factory()
            ->count(2)
            ->create([
                'payment_method_id' => $paymentMethod->id,
            ]);

        $response = $this->getJson(
            route('api.payment-methods.sales-orders.index', $paymentMethod)
        );

        $response->assertOk()->assertSee($salesOrders[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_payment_method_sales_orders(): void
    {
        $paymentMethod = PaymentMethod::factory()->create();
        $data = SalesOrder::factory()
            ->make([
                'payment_method_id' => $paymentMethod->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.payment-methods.sales-orders.store', $paymentMethod),
            $data
        );

        $this->assertDatabaseHas('sales_orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesOrder = SalesOrder::latest('id')->first();

        $this->assertEquals($paymentMethod->id, $salesOrder->payment_method_id);
    }
}
