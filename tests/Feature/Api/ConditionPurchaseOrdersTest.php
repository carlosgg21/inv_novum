<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Condition;
use App\Models\PurchaseOrder;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConditionPurchaseOrdersTest extends TestCase
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
    public function it_gets_condition_purchase_orders(): void
    {
        $condition = Condition::factory()->create();
        $purchaseOrders = PurchaseOrder::factory()
            ->count(2)
            ->create([
                'condition_id' => $condition->id,
            ]);

        $response = $this->getJson(
            route('api.conditions.purchase-orders.index', $condition)
        );

        $response->assertOk()->assertSee($purchaseOrders[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_condition_purchase_orders(): void
    {
        $condition = Condition::factory()->create();
        $data = PurchaseOrder::factory()
            ->make([
                'condition_id' => $condition->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.conditions.purchase-orders.store', $condition),
            $data
        );

        unset($data['prefix']);

        $this->assertDatabaseHas('purchase_orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $purchaseOrder = PurchaseOrder::latest('id')->first();

        $this->assertEquals($condition->id, $purchaseOrder->condition_id);
    }
}
