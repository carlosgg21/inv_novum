<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Customer;
use App\Models\PaymentsReceived;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerPaymentsReceivedsTest extends TestCase
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
    public function it_gets_customer_payments_receiveds(): void
    {
        $customer = Customer::factory()->create();
        $paymentsReceiveds = PaymentsReceived::factory()
            ->count(2)
            ->create([
                'customer_id' => $customer->id,
            ]);

        $response = $this->getJson(
            route('api.customers.payments-receiveds.index', $customer)
        );

        $response->assertOk()->assertSee($paymentsReceiveds[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_customer_payments_receiveds(): void
    {
        $customer = Customer::factory()->create();
        $data = PaymentsReceived::factory()
            ->make([
                'customer_id' => $customer->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.customers.payments-receiveds.store', $customer),
            $data
        );

        $this->assertDatabaseHas('payments_receiveds', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $paymentsReceived = PaymentsReceived::latest('id')->first();

        $this->assertEquals($customer->id, $paymentsReceived->customer_id);
    }
}
