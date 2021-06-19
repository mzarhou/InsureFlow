<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function client()
    {
        return $this->vehicule->client();
    }
}
