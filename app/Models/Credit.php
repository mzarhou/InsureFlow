<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }

    public function paiement()
    {
        return $this->hasMany(PaiementCredit::class, "credit_id");
    }

    public function vehicule () {
        return $this->contrat->vehicule();
    }

    public function client () {
        return $this->contrat->client();
    }
}
