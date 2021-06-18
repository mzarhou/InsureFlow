<?php

namespace Tests\Feature;

use App\Models\Charge;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GestionChargesTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    /** @test */
    public function can_render_charges_index_page()
    {
        $response = $this->get(route("gestion-charges.index"));
        $response->assertStatus(200);
    }

    /** @test */
    public function add_charge()
    {
        $response = $this->post(route("gestion-charges.store"), [
            "montant" => 260,
            "description" => "lorem lorem lorem",
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route("gestion-charges.index"));
    }

    /** @test */
    public function edit_charge()
    {
        $charge = Charge::factory()->create();
        $response = $this->patch(route("gestion-charges.update", $charge->id), [
            "montant" => 11,
            "description" => "test description"
        ]);

        $this->assertNotEquals($charge->montant, 11);
        $this->assertNotEquals($charge->description, "test description");

        $charge->refresh();
        $this->assertEquals($charge->montant, 11);
        $this->assertEquals($charge->description, "test description");

        $response->assertStatus(302);
        $response->assertRedirect(route("gestion-charges.index"));
    }

    /** @test */
    public function charge_can_be_deleted()
    {
        $charge = Charge::factory()->create();

        $response = $this->delete(route("gestion-charges.destroy", $charge));

        $this->assertNull($charge->fresh());
        $response->assertRedirect(route("gestion-charges.index"));
    }
}
