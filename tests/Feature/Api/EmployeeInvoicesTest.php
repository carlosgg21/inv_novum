<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Employee;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeInvoicesTest extends TestCase
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
    public function it_gets_employee_invoices(): void
    {
        $employee = Employee::factory()->create();
        $invoices = Invoice::factory()
            ->count(2)
            ->create([
                'employee_id' => $employee->id,
            ]);

        $response = $this->getJson(
            route('api.employees.invoices.index', $employee)
        );

        $response->assertOk()->assertSee($invoices[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_employee_invoices(): void
    {
        $employee = Employee::factory()->create();
        $data = Invoice::factory()
            ->make([
                'employee_id' => $employee->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.employees.invoices.store', $employee),
            $data
        );

        $this->assertDatabaseHas('invoices', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $invoice = Invoice::latest('id')->first();

        $this->assertEquals($employee->id, $invoice->employee_id);
    }
}
