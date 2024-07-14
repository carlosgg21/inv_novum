<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\PurchaseOrder;

use App\Models\Supplier;
use App\Models\Condition;
use App\Models\PaymentTerm;
use App\Models\PaymentMethod;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PurchaseOrderControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_purchase_orders(): void
    {
        $purchaseOrders = PurchaseOrder::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('purchase-orders.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.purchase_orders.index')
            ->assertViewHas('purchaseOrders');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_purchase_order(): void
    {
        $response = $this->get(route('purchase-orders.create'));

        $response->assertOk()->assertViewIs('app.purchase_orders.create');
    }

    /**
     * @test
     */
    public function it_stores_the_purchase_order(): void
    {
        $data = PurchaseOrder::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('purchase-orders.store'), $data);

        unset($data['prefix']);

        $this->assertDatabaseHas('purchase_orders', $data);

        $purchaseOrder = PurchaseOrder::latest('id')->first();

        $response->assertRedirect(
            route('purchase-orders.edit', $purchaseOrder)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_purchase_order(): void
    {
        $purchaseOrder = PurchaseOrder::factory()->create();

        $response = $this->get(route('purchase-orders.show', $purchaseOrder));

        $response
            ->assertOk()
            ->assertViewIs('app.purchase_orders.show')
            ->assertViewHas('purchaseOrder');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_purchase_order(): void
    {
        $purchaseOrder = PurchaseOrder::factory()->create();

        $response = $this->get(route('purchase-orders.edit', $purchaseOrder));

        $response
            ->assertOk()
            ->assertViewIs('app.purchase_orders.edit')
            ->assertViewHas('purchaseOrder');
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

        $response = $this->put(
            route('purchase-orders.update', $purchaseOrder),
            $data
        );

        unset($data['prefix']);

        $data['id'] = $purchaseOrder->id;

        $this->assertDatabaseHas('purchase_orders', $data);

        $response->assertRedirect(
            route('purchase-orders.edit', $purchaseOrder)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_purchase_order(): void
    {
        $purchaseOrder = PurchaseOrder::factory()->create();

        $response = $this->delete(
            route('purchase-orders.destroy', $purchaseOrder)
        );

        $response->assertRedirect(route('purchase-orders.index'));

        $this->assertSoftDeleted($purchaseOrder);
    }
}
