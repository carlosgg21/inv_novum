<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Employee;
use App\Models\PaymentMade;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeePaymentMadesTest extends TestCase
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
    public function it_gets_employee_payment_mades(): void
    {
        $employee = Employee::factory()->create();
        $paymentMades = PaymentMade::factory()
            ->count(2)
            ->create([
                'created_by' => $employee->id,
            ]);

        $response = $this->getJson(
            route('api.employees.payment-mades.index', $employee)
        );

        $response->assertOk()->assertSee($paymentMades[0]->reference_number);
    }

    /**
     * @test
     */
    public function it_stores_the_employee_payment_mades(): void
    {
        $employee = Employee::factory()->create();
        $data = PaymentMade::factory()
            ->make([
                'created_by' => $employee->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.employees.payment-mades.store', $employee),
            $data
        );

        $this->assertDatabaseHas('payment_mades', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $paymentMade = PaymentMade::latest('id')->first();

        $this->assertEquals($employee->id, $paymentMade->created_by);
    }
}
