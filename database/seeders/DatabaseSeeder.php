<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);

        \App\Models\Client::factory(100)
            ->afterCreating(function ($client) {
                \App\Models\Vehicule::factory()
                    ->afterCreating(function ($vehicule) {
                        \App\Models\Contrat::factory()->create([
                            "vehicule_id" => $vehicule->id
                        ]);
                    })
                    ->create([
                        "client_id" => $client->id,
                    ]);
            })
            ->create();

        $this->call(CreditSeeder::class);
        $this->call(PaiementCreditSeeder::class);
        $this->call(ResiliationSeeder::class);
    }
}
