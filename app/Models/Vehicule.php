<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function contrat()
    {
        return $this->hasMany(Contrat::class);
    }
}
