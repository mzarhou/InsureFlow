<?php

namespace Database\Factories;

use App\Models\Contrat;
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

        return [
            'type_paiement' => $types_paiement[array_rand($types_paiement)],
            'montant_total' => $this->faker->numberBetween(500, 10000),
            'du_date' => $this->faker->dateTime(),
            'au_date' => $this->faker->dateTime()
        ];
    }
}
