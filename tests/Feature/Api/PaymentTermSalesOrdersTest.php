<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesOrder;
use App\Models\PaymentTerm;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentTermSalesOrdersTest extends TestCase
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
    public function it_gets_payment_term_sales_orders(): void
    {
        $paymentTerm = PaymentTerm::factory()->create();
        $salesOrders = SalesOrder::factory()
            ->count(2)
            ->create([
                'payment_term_id' => $paymentTerm->id,
            ]);

        $response = $this->getJson(
            route('api.payment-terms.sales-orders.index', $paymentTerm)
        );

        $response->assertOk()->assertSee($salesOrders[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_payment_term_sales_orders(): void
    {
        $paymentTerm = PaymentTerm::factory()->create();
        $data = SalesOrder::factory()
            ->make([
                'payment_term_id' => $paymentTerm->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.payment-terms.sales-orders.store', $paymentTerm),
            $data
        );

        $this->assertDatabaseHas('sales_orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesOrder = SalesOrder::latest('id')->first();

        $this->assertEquals($paymentTerm->id, $salesOrder->payment_term_id);
    }
}
