<?php

namespace Database\Factories;

use App\Models\PaiementCredit;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaiementCreditFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaiementCredit::class;

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
            "montant" => $this->faker->numberBetween(100, 1000),
            'type_paiement' => $types_paiement[array_rand($types_paiement)],
        ];
    }
}
