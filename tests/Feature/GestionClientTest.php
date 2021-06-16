<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Contrat;
use App\Models\Vehicule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GestionClientTest extends TestCase
{
    /** @test */
    public function can_render_client_index_page()
    {
        $response = $this->get("/gestion-client");
        $response->assertStatus(200);
    }

    /** @test */
    public function add_client()
    {
        $response = $this->post("/gestion-client", [
            "personnelles" => [
                "nom" => "Jamal",
                "cin" => "3242343",
                "tele" => "072346234",
                "addresse" => "example addresse",
            ],

            "vehicule" => [
                "puissance_energie" => "Gaz",
                "numero_immatriculation" => "34135324134",
                "marque_type" => "Mercedes",
                "type_carrosserie" => "",
                "date_1er_mise_en" => "",
                "usage" => "C1X",
                "cylindree" => "3",
                "remorques" => "0",
                "poids_total_en_charge" => "3500"
            ],

            "contrat" => [
                "type_paiement" => "Virement",
                "du_date" => "2021-06-16 19:40:44",
                "au_date" => "2022-06-16 19:40:44",
                "nombre_places" => "6"
            ]
        ]);


        $response->assertStatus(302);

        $client = Client::where(["nom" => "Jamal", "tele" => "072346234", "addresse" => "example addresse"])->first();
        $this->assertNotNull($client);

        $vehicule = Vehicule::where(["puissance_energie" => "Gaz", "numero_immatriculation" => "34135324134"])->first();
        $this->assertNotNull($vehicule);

        $contrat = Contrat::where(["du_date" => "2021-06-16 19:40:44", "au_date" => "2022-06-16 19:40:44"])->first();
        $this->assertNotNull($contrat);
    }
}
