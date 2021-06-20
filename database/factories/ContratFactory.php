<?php

namespace Database\Factories;

use App\Models\Contrat;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContratFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contrat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types_paiement = [
            'Espece',
            'Cheque',
            'Credit',
            'Virement',
        ];

        // $dateTime = Carbon::now()->subDays(rand(15, 300));

        return [
            'type_paiement' => $types_paiement[array_rand($types_paiement)],
            'montant_total' => $this->faker->numberBetween(500, 10000),
            'du_date' => $this->faker->dateTime(),
            'au_date' => '2025-05-02 22:00:00',
        ];
    }
}
