<?php

namespace App\Http\Requests;

use App\Models\Credit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StorePaiementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "type_paiement" => ["required", "in:Espece,Cheque,Credit,Virement"],
            "montant" => ["required", "numeric"],
            "credit_id" => ["exists:credits,id"]
        ];
    }
}
