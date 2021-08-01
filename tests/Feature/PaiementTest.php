<?php

namespace Tests\Feature;

use App\Models\PaiementCredit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\CreateClient;
use Tests\TestCase;

class PaiementTest extends TestCase
{
    use RefreshDatabase;
    use CreateClient;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    /** @test */
    public function paiements_screen_can_be_rendered()
    {
        $credit = $this->getClientCredit();
        $response = $this->get(route("credit.show", $credit));
        $response->assertStatus(200);
    }

    /** @test */
    public function can_not_pay_for_completed_credit_and_pay_for_incompleted()
    {
        $credit = $this->getClientCredit();

        // completed
        $credit->update(["completed" => now(), "credit" => 200]);
        $this->checkPaiement(100, $credit, 0, 403);
        $this->assertNotNull($credit->completed);

        // incompleted
        $credit->update(["completed" => null]);
        $this->checkPaiement(100, $credit, 1, 302);
        $this->assertNull($credit->completed);
    }

    /** @test */
    public function paid_amounts_can_not_be_greater_than_credit_amount()
    {
        $amount = 400;
        $credit = $this->getClientCredit();
        $credit->update([
            "completed" => null,
            "montant_total" => $amount
        ]);
        $this->checkPaiement($amount + 1, $credit, 0, 409);
    }

    /** @test */
    public function can_pay()
    {
        $amount = 1000;
        $times = 10;
        $credit = $this->getClientCredit();
        $credit->update([
            "completed" => null,
            "montant_total" => $amount * $times
        ]);

        // check same amount
        $this->checkPaiement($amount * $times, $credit, 1, 302);
        PaiementCredit::all()->each(fn ($paiement) => $paiement->delete());

        // check multiple payment
        for ($i = 1; $i <= $times; $i++)
            $this->checkPaiement($amount, $credit, $i, 302);
    }

    // utils
    private function checkPaiement ($amount, $credit, $paiements_count, $status)
    {
        $response = $this->pay($amount, $credit);
        $credit->refresh();
        $response->assertStatus($status);
        $this->assertEquals($paiements_count, $credit->paiements->count());
    }

    private function pay($amount, $credit): TestResponse
    {
        return $this->post(route("paiement.store"), [
            "type_paiement" => "Espece",
            "montant" => $amount,
            "credit_id" => $credit->id
        ]);
    }
}
