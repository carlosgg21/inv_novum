<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PurchaseOrder;

use App\Models\Supplier;
use App\Models\Condition;
use App\Models\PaymentTerm;
use App\Models\PaymentMethod;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PurchaseOrderTest extends TestCase
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
    public function it_gets_purchase_orders_list(): void
    {
        $purchaseOrders = PurchaseOrder::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.purchase-orders.index'));

        $response->assertOk()->assertSee($purchaseOrders[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_purchase_order(): void
    {
        $data = PurchaseOrder::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.purchase-orders.store'), $data);

        unset($data['prefix']);

        $this->assertDatabaseHas('purchase_orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_purchase_order(): void
    {
        $purchaseOrder = PurchaseOrder::factory()->create();

        $supplier = Supplier::factory()->create();
        $paymentMethod = PaymentMethod::factory()->create();
        $paymentTerm = PaymentTerm::factory()->create();
        $condition = Condition::factory()->create();

        $data = [
            'number' => $this->faker->text(255),
            'prefix' => $this->faker->text(255),
            'order_date' => $this->faker->date(),
            'total_amount' => $this->faker->randomNumber(2),
            'status' => 'not entered',
            'taxes' => $this->faker->randomNumber(2),
            'discount' => $this->faker->randomNumber(2),
            'miscellaneous' => $this->faker->randomNumber(2),
            'shipping_date' => $this->faker->date(),
            'shipping_cost' => $this->faker->randomNumber(2),
            'shippin_tracking_number' => $this->faker->text(255),
            'received_date' => $this->faker->date(),
            'billable' => $this->faker->boolean(),
            'supplier_id' => $supplier->id,
            'payment_method_id' => $paymentMethod->id,
            'payment_term_id' => $paymentTerm->id,
            'condition_id' => $condition->id,
        ];

        $response = $this->putJson(
            route('api.purchase-orders.update', $purchaseOrder),
            $data
        );

        unset($data['prefix']);

        $data['id'] = $purchaseOrder->id;

        $this->assertDatabaseHas('purchase_orders', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_purchase_order(): void
    {
        $purchaseOrder = PurchaseOrder::factory()->create();

        $response = $this->deleteJson(
            route('api.purchase-orders.destroy', $purchaseOrder)
        );

        $this->assertSoftDeleted($purchaseOrder);

        $response->assertNoContent();
    }
}
