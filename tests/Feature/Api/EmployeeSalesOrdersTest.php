<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Employee;
use App\Models\SalesOrder;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeSalesOrdersTest extends TestCase
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
    public function it_gets_employee_sales_orders(): void
    {
        $employee = Employee::factory()->create();
        $salesOrders = SalesOrder::factory()
            ->count(2)
            ->create([
                'sold_by' => $employee->id,
            ]);

        $response = $this->getJson(
            route('api.employees.sales-orders.index', $employee)
        );

        $response->assertOk()->assertSee($salesOrders[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_employee_sales_orders(): void
    {
        $employee = Employee::factory()->create();
        $data = SalesOrder::factory()
            ->make([
                'sold_by' => $employee->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.employees.sales-orders.store', $employee),
            $data
        );

        $this->assertDatabaseHas('sales_orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesOrder = SalesOrder::latest('id')->first();

        $this->assertEquals($employee->id, $salesOrder->sold_by);
    }
}
