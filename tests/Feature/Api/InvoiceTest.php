<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Invoice;

use App\Models\Employee;
use App\Models\Currency;
use App\Models\SalesOrder;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvoiceTest extends TestCase
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
    public function it_gets_invoices_list(): void
    {
        $invoices = Invoice::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.invoices.index'));

        $response->assertOk()->assertSee($invoices[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_invoice(): void
    {
        $data = Invoice::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.invoices.store'), $data);

        $this->assertDatabaseHas('invoices', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_invoice(): void
    {
        $invoice = Invoice::factory()->create();

        $salesOrder = SalesOrder::factory()->create();
        $employee = Employee::factory()->create();
        $currency = Currency::factory()->create();

        $data = [
            'number' => $this->faker->text(255),
            'date' => $this->faker->date(),
            'total_amount' => $this->faker->randomNumber(2),
            'status' => $this->faker->word(),
            'year' => $this->faker->text(255),
            'mount' => $this->faker->randomNumber(0),
            'notes' => $this->faker->text(),
            'sales_order_id' => $salesOrder->id,
            'employee_id' => $employee->id,
            'currency_id' => $currency->id,
        ];

        $response = $this->putJson(
            route('api.invoices.update', $invoice),
            $data
        );

        $data['id'] = $invoice->id;

        $this->assertDatabaseHas('invoices', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_invoice(): void
    {
        $invoice = Invoice::factory()->create();

        $response = $this->deleteJson(route('api.invoices.destroy', $invoice));

        $this->assertModelMissing($invoice);

        $response->assertNoContent();
    }
}
