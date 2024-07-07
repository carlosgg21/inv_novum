<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\PaymentTerm;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentTermControllerTest extends TestCase
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
    public function it_displays_index_view_with_payment_terms(): void
    {
        $paymentTerms = PaymentTerm::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('payment-terms.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.payment_terms.index')
            ->assertViewHas('paymentTerms');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_payment_term(): void
    {
        $response = $this->get(route('payment-terms.create'));

        $response->assertOk()->assertViewIs('app.payment_terms.create');
    }

    /**
     * @test
     */
    public function it_stores_the_payment_term(): void
    {
        $data = PaymentTerm::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('payment-terms.store'), $data);

        unset($data['code']);

        $this->assertDatabaseHas('payment_terms', $data);

        $paymentTerm = PaymentTerm::latest('id')->first();

        $response->assertRedirect(route('payment-terms.edit', $paymentTerm));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_payment_term(): void
    {
        $paymentTerm = PaymentTerm::factory()->create();

        $response = $this->get(route('payment-terms.show', $paymentTerm));

        $response
            ->assertOk()
            ->assertViewIs('app.payment_terms.show')
            ->assertViewHas('paymentTerm');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_payment_term(): void
    {
        $paymentTerm = PaymentTerm::factory()->create();

        $response = $this->get(route('payment-terms.edit', $paymentTerm));

        $response
            ->assertOk()
            ->assertViewIs('app.payment_terms.edit')
            ->assertViewHas('paymentTerm');
    }

    /**
     * @test
     */
    public function it_updates_the_payment_term(): void
    {
        $paymentTerm = PaymentTerm::factory()->create();

        $data = [
            'description' => $this->faker->sentence(15),
            'day' => $this->faker->randomNumber(0),
            'code' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('payment-terms.update', $paymentTerm),
            $data
        );

        unset($data['code']);

        $data['id'] = $paymentTerm->id;

        $this->assertDatabaseHas('payment_terms', $data);

        $response->assertRedirect(route('payment-terms.edit', $paymentTerm));
    }

    /**
     * @test
     */
    public function it_deletes_the_payment_term(): void
    {
        $paymentTerm = PaymentTerm::factory()->create();

        $response = $this->delete(route('payment-terms.destroy', $paymentTerm));

        $response->assertRedirect(route('payment-terms.index'));

        $this->assertSoftDeleted($paymentTerm);
    }
}
