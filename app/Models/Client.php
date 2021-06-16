<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }

    public function contrats()
    {
        return $this->hasManyThrough(Contrat::class, Vehicule::class);
    }
}
