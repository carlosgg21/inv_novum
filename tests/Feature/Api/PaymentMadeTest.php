<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PaymentMade;

use App\Models\Supplier;
use App\Models\Employee;
use App\Models\PaymentTerm;
use App\Models\PaymentMethod;
use App\Models\PurchaseOrder;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentMadeTest extends TestCase
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
    public function it_gets_payment_mades_list(): void
    {
        $paymentMades = PaymentMade::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.payment-mades.index'));

        $response->assertOk()->assertSee($paymentMades[0]->reference_number);
    }

    /**
     * @test
     */
    public function it_stores_the_payment_made(): void
    {
        $data = PaymentMade::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.payment-mades.store'), $data);

        $this->assertDatabaseHas('payment_mades', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_payment_made(): void
    {
        $paymentMade = PaymentMade::factory()->create();

        $supplier = Supplier::factory()->create();
        $paymentMethod = PaymentMethod::factory()->create();
        $paymentTerm = PaymentTerm::factory()->create();
        $purchaseOrder = PurchaseOrder::factory()->create();
        $employee = Employee::factory()->create();

        $data = [
            'amount' => $this->faker->randomNumber(2),
            'reference_number' => $this->faker->text(255),
            'date' => $this->faker->date(),
            'aproved_by' => $this->faker->text(255),
            'supplier_id' => $supplier->id,
            'payment_method_id' => $paymentMethod->id,
            'payment_term_id' => $paymentTerm->id,
            'purchase_order_id' => $purchaseOrder->id,
            'created_by' => $employee->id,
        ];

        $response = $this->putJson(
            route('api.payment-mades.update', $paymentMade),
            $data
        );

        $data['id'] = $paymentMade->id;

        $this->assertDatabaseHas('payment_mades', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_payment_made(): void
    {
        $paymentMade = PaymentMade::factory()->create();

        $response = $this->deleteJson(
            route('api.payment-mades.destroy', $paymentMade)
        );

        $this->assertSoftDeleted($paymentMade);

        $response->assertNoContent();
    }
}
