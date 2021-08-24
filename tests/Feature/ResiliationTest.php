<?php

namespace Tests\Feature;

use App\Models\Contrat;
use App\Models\User;
use Database\Seeders\ClientSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreateClient;
use Tests\TestCase;

class ResiliationTest extends TestCase
{
    use RefreshDatabase;
    use CreateClient;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ajouter_resiliation()
    {
        $contrat = $this->getClientContrat();
        $response = $this->post(route("resiliation.store"), [
            "montant" => 2343,
            "contrat_id" => $contrat->id
        ]);

        $response->assertRedirect(
            route("gestion-clients.show", $contrat->client->id)
        );
        $response->assertStatus(302);
    }

    public function test_ajouter_resiliation_with_credit()
    {
        $contrat = $this->getClientContratWithCreditNotCompleted();
        $response = $this->post(route("resiliation.store"), [
            "montant" => 100,
            "montant_total" => 2343,
            "contrat_id" => $contrat->id
        ]);

        $response->assertRedirect(
            route("gestion-clients.show", $contrat->client->id)
        );
        $contrat = Contrat::find($contrat->id);
        $response->assertStatus(302);
        $this->assertFalse(!!$contrat->is_active);
    }
}
