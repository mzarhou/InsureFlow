<?php

namespace Database\Seeders;

use App\Models\Contrat;
use App\Models\Resiliation;
use Illuminate\Database\Seeder;

class ResiliationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contrat::all()->random(10)->map(function ($contrat) {
            Resiliation::factory()->create([
                "contrat_id" => $contrat->id
            ]);
        });
    }
}
