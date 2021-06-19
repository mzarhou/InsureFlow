<?php

namespace Database\Seeders;

use App\Models\Credit;
use App\Models\PaiementCredit;
use Illuminate\Database\Seeder;

class PaiementCreditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Credit::all()->random(5)->map(function ($credit) {
            PaiementCredit::factory()->create([
                "credit_id" => $credit->id,
            ]);
        });
    }
}
