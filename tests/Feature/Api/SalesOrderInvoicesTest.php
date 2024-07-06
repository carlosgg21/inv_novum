<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Invoice;
use App\Models\SalesOrder;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesOrderInvoicesTest extends TestCase
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
    public function it_gets_sales_order_invoices(): void
    {
        $salesOrder = SalesOrder::factory()->create();
        $invoices = Invoice::factory()
            ->count(2)
            ->create([
                'sales_order_id' => $salesOrder->id,
            ]);

        $response = $this->getJson(
            route('api.sales-orders.invoices.index', $salesOrder)
        );

        $response->assertOk()->assertSee($invoices[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_order_invoices(): void
    {
        $salesOrder = SalesOrder::factory()->create();
        $data = Invoice::factory()
            ->make([
                'sales_order_id' => $salesOrder->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.sales-orders.invoices.store', $salesOrder),
            $data
        );

        $this->assertDatabaseHas('invoices', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $invoice = Invoice::latest('id')->first();

        $this->assertEquals($salesOrder->id, $invoice->sales_order_id);
    }
}
