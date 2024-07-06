<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Supplier;
use App\Models\PaymentMade;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupplierPaymentMadesTest extends TestCase
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
    public function it_gets_supplier_payment_mades(): void
    {
        $supplier = Supplier::factory()->create();
        $paymentMades = PaymentMade::factory()
            ->count(2)
            ->create([
                'supplier_id' => $supplier->id,
            ]);

        $response = $this->getJson(
            route('api.suppliers.payment-mades.index', $supplier)
        );

        $response->assertOk()->assertSee($paymentMades[0]->reference_number);
    }

    /**
     * @test
     */
    public function it_stores_the_supplier_payment_mades(): void
    {
        $supplier = Supplier::factory()->create();
        $data = PaymentMade::factory()
            ->make([
                'supplier_id' => $supplier->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.suppliers.payment-mades.store', $supplier),
            $data
        );

        $this->assertDatabaseHas('payment_mades', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $paymentMade = PaymentMade::latest('id')->first();

        $this->assertEquals($supplier->id, $paymentMade->supplier_id);
    }
}
