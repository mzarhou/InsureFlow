<?php

namespace Tests\Feature;

use App\Models\Credit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GestionCreditTest extends TestCase
{
    /** @test */
    public function ajouter_paiement()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $credit = Credit::all()->random();
        $response = $this->post(route("paiement.store"), [
            "credit_id" => $credit->id,
            "montant" => 433333,
            "type_paiement" => "Virement",
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route("credit.show", $credit->id));
    }
}
