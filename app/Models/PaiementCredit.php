<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementCredit extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function credit()
    {
        return $this->belongsTo(Credit::class, "credit_id");
    }
}
