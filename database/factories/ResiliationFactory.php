<?php

namespace Database\Factories;

use App\Models\Resiliation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResiliationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resiliation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $montant_total = $this->faker->numberBetween(500, 1000);
        return [
            "montant" => $montant_total,
            "montant_total" => $montant_total,
        ];
    }
}
