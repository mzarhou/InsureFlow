<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Contrat;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GestionClientTest extends TestCase
{
    use RefreshDatabase;

    protected $data = [
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
            "date_1er_mise_en" => "2020-06-01",
            "usage" => "C1X",
            "cylindree" => "3",
            "remorques" => "0",
            "poids_total_en_charge" => "3500",
            "nombre_places" => "6"
        ],

        "contrat" => [
            "type_paiement" => "Virement",
            "du_date" => "2021-06-16 19:40:44",
            "au_date" => "2022-06-16 19:40:44",
            "montant_total" => "2500",
        ]
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    /** @test */
    public function can_render_client_index_page()
    {
        $response = $this->get(route("gestion-clients.index"));
        $response->assertStatus(200);
    }

    /** @test */
    public function can_render_client_create_page()
    {
        $response = $this->get(route("gestion-clients.create"));
        $response->assertStatus(200);
    }

    /** @test */
    public function add_client()
    {
        $response = $this->post(route("gestion-clients.store"), $this->data);

        $response->assertStatus(302);

        $client = Client::where(["nom" => "Jamal", "tele" => "072346234", "addresse" => "example addresse"])->first();
        $this->assertNotNull($client);

        $vehicule = Vehicule::where(["puissance_energie" => "Gaz", "numero_immatriculation" => "34135324134"])->first();
        $this->assertNotNull($vehicule);

        $contrat = Contrat::where(["du_date" => "2021-06-16 19:40:44", "au_date" => "2022-06-16 19:40:44"])->first();
        $this->assertNotNull($contrat);

        $response->assertRedirect(route("gestion-clients.index"));
    }

    /** @test */
    public function unique_cin()
    {
        $this->post(route("gestion-clients.store"), $this->data);
        $response = $this->post(route("gestion-clients.store"), $this->data);
        $response->assertSessionHas("errors");
    }
}
