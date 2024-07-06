<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\PaymentMade;

use App\Models\Supplier;
use App\Models\Employee;
use App\Models\PaymentTerm;
use App\Models\PaymentMethod;
use App\Models\PurchaseOrder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentMadeControllerTest extends TestCase
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
    public function it_displays_index_view_with_payment_mades(): void
    {
        $paymentMades = PaymentMade::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('payment-mades.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.payment_mades.index')
            ->assertViewHas('paymentMades');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_payment_made(): void
    {
        $response = $this->get(route('payment-mades.create'));

        $response->assertOk()->assertViewIs('app.payment_mades.create');
    }

    /**
     * @test
     */
    public function it_stores_the_payment_made(): void
    {
        $data = PaymentMade::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('payment-mades.store'), $data);

        $this->assertDatabaseHas('payment_mades', $data);

        $paymentMade = PaymentMade::latest('id')->first();

        $response->assertRedirect(route('payment-mades.edit', $paymentMade));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_payment_made(): void
    {
        $paymentMade = PaymentMade::factory()->create();

        $response = $this->get(route('payment-mades.show', $paymentMade));

        $response
            ->assertOk()
            ->assertViewIs('app.payment_mades.show')
            ->assertViewHas('paymentMade');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_payment_made(): void
    {
        $paymentMade = PaymentMade::factory()->create();

        $response = $this->get(route('payment-mades.edit', $paymentMade));

        $response
            ->assertOk()
            ->assertViewIs('app.payment_mades.edit')
            ->assertViewHas('paymentMade');
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

        $response = $this->put(
            route('payment-mades.update', $paymentMade),
            $data
        );

        $data['id'] = $paymentMade->id;

        $this->assertDatabaseHas('payment_mades', $data);

        $response->assertRedirect(route('payment-mades.edit', $paymentMade));
    }

    /**
     * @test
     */
    public function it_deletes_the_payment_made(): void
    {
        $paymentMade = PaymentMade::factory()->create();

        $response = $this->delete(route('payment-mades.destroy', $paymentMade));

        $response->assertRedirect(route('payment-mades.index'));

        $this->assertSoftDeleted($paymentMade);
    }
}
