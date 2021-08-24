<?php

namespace Tests;

use App\Models\Client;
use App\Models\Contrat;
use App\Models\Credit;
use App\Models\Vehicule;
use Database\Seeders\ClientSeeder;

trait CreateClient {

    public function createClient($createCreditCallback = null): Client
    {
        return \App\Models\Client::factory()
            ->has(
                Vehicule::factory()
                    ->has(
                        Contrat::factory()
                            ->afterCreating(function ($contrat) use ($createCreditCallback) {
                                if (!$createCreditCallback) {
                                    Credit::factory()
                                        ->create([
                                            "contrat_id" => $contrat->id
                                        ]);
                                } else {
                                    $createCreditCallback($contrat);
                                }
                            })
                    )
            )->create();
    }

    public function createClientWithCreditNotCompleted(): Client
    {
        return $this->createClient(function ($contrat) {
            Credit::factory()
                ->create([
                    "contrat_id" => $contrat->id,
                    "completed" => null
                ]);
        });
    }

    public function getClientCredit(): Credit
    {
        $client = $this->createClient();
        return $client?->contrats?->first()?->credit;
    }

    public function getClientCreditNotCompleted(): Credit
    {
        $client = $this->createClientWithCreditNotCompleted();
        return $client->contrats->first()->credit;
    }

    public function getClientContrat(): Contrat
    {
        $client = $this->createClient();
        return $client?->contrats?->first();
    }

    public function getClientContratWithCreditNotCompleted(): Contrat
    {
        $client = $this->createClientWithCreditNotCompleted();
        return $client?->contrats?->first();
    }
}
