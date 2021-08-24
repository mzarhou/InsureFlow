<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Contrat;
use App\Models\Credit;
use App\Models\User;
use App\Models\Vehicule;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreateClient;
use Tests\TestCase;

class GestionCreditTest extends TestCase
{
    use RefreshDatabase;
    use CreateClient;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    /** @test */
    public function mark_credit_as_completed()
    {
        $credit = $this->getClientCreditNotCompleted();
        $response = $this->put(route("credit.complete", $credit));

        $this->assertNull($credit->completed);
        $this->assertNotNull($credit->fresh()->completed);
        $response->assertStatus(302);
        $response->assertRedirect(route("credit.show", $credit->id));
    }
}
