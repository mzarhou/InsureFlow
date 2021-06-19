<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function credit()
    {
        return $this->hasOneThrough(Credit::class, Contrat::class);
    }
}
