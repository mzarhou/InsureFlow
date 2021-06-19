<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Contrat;
use App\Models\Credit;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GestionCreditTest extends TestCase
{
    // use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    /** @test */
    public function ajouter_paiement()
    {
        $credit = Credit::all()->random();
        $response = $this->post(route("paiement.store"), [
            "credit_id" => $credit->id,
            "montant" => 433333,
            "type_paiement" => "Virement",
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route("credit.show", $credit->id));
    }

    /** @test */
    public function mark_credit_as_completed()
    {
        $client = Client::factory()->create();
        $vehicule = Vehicule::factory()->create([
            "client_id" => $client->id
        ]);
        $contrat = Contrat::factory()->create([
            "vehicule_id" => $vehicule->id
        ]);
        $credit = Credit::factory()->create([
            "contrat_id" => $contrat->id,
            "completed" => null
        ]);

        $response = $this->put(route("credit.complete", $credit));

        $this->assertNull($credit->completed);
        $this->assertNotNull($credit->fresh()->completed);
        $response->assertStatus(302);
        $response->assertRedirect(route("credit.show", $credit->id));
    }
}
