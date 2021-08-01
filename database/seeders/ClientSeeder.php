<?php

namespace Database\Seeders;

use App\Models\Contrat;
use App\Models\Credit;
use App\Models\PaiementCredit;
use App\Models\Resiliation;
use App\Models\Vehicule;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return \App\Models\Client::factory()
            ->has(
                Vehicule::factory()
                    ->has(
                        Contrat::factory()
                            ->afterCreating(function ($contrat) {
                                Credit::factory()
                                    ->create([
                                        "contrat_id" => $contrat->id
                                    ]);
                            })
                    )
            )->create();
    }
}
