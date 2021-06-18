<?php

namespace Database\Factories;

use App\Models\Vehicule;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehiculeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $puissance_energie = [
            'Diesel',
            'Essance',
            'Gaz',
        ];

        return [
            'puissance_energie' => $puissance_energie[array_rand($puissance_energie)],
            'numero_immatriculation' => $this->faker->address,
            'marque_type' => $this->faker->text(6),
            'type_carrosserie' => $this->faker->text(6),
            'date_1er_mise_en' => $this->faker->date(),
            'usage' => $this->faker->text(6),
            'cylindree' => $this->faker->numberBetween(0, 6),
            'remorques' => $this->faker->numberBetween(0, 1),
            'poids_total_en_charge' => $this->faker->numberBetween(600, 10000),
            'nombre_places' => $this->faker->numberBetween(4, 10),
        ];
    }
}
