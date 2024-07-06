<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesOrder;
use App\Models\PaymentsReceived;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesOrderPaymentsReceivedsTest extends TestCase
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
    public function it_gets_sales_order_payments_receiveds(): void
    {
        $salesOrder = SalesOrder::factory()->create();
        $paymentsReceiveds = PaymentsReceived::factory()
            ->count(2)
            ->create([
                'sales_order_id' => $salesOrder->id,
            ]);

        $response = $this->getJson(
            route('api.sales-orders.payments-receiveds.index', $salesOrder)
        );

        $response->assertOk()->assertSee($paymentsReceiveds[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_order_payments_receiveds(): void
    {
        $salesOrder = SalesOrder::factory()->create();
        $data = PaymentsReceived::factory()
            ->make([
                'sales_order_id' => $salesOrder->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.sales-orders.payments-receiveds.store', $salesOrder),
            $data
        );

        $this->assertDatabaseHas('payments_receiveds', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $paymentsReceived = PaymentsReceived::latest('id')->first();

        $this->assertEquals($salesOrder->id, $paymentsReceived->sales_order_id);
    }
}
