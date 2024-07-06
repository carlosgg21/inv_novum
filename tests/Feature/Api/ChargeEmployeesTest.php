<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Charge;
use App\Models\Employee;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChargeEmployeesTest extends TestCase
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
    public function it_gets_charge_employees(): void
    {
        $charge = Charge::factory()->create();
        $employees = Employee::factory()
            ->count(2)
            ->create([
                'charge_id' => $charge->id,
            ]);

        $response = $this->getJson(
            route('api.charges.employees.index', $charge)
        );

        $response->assertOk()->assertSee($employees[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_charge_employees(): void
    {
        $charge = Charge::factory()->create();
        $data = Employee::factory()
            ->make([
                'charge_id' => $charge->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.charges.employees.store', $charge),
            $data
        );

        unset($data['company_id']);

        $this->assertDatabaseHas('employees', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $employee = Employee::latest('id')->first();

        $this->assertEquals($charge->id, $employee->charge_id);
    }
}
