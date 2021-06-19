<?php

namespace Database\Seeders;

use App\Models\Contrat;
use App\Models\Credit;
use Illuminate\Database\Seeder;

class CreditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contrat::all()->random(10)->map(function ($contrat) {
            Credit::factory()->create([
                "contrat_id" => $contrat->id
            ]);
        });
    }
}
