<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $clientRules = [
            "personnelles.nom" => ["required", "string", "min:3"],
            "personnelles.cin" => ["required", "unique:clients,cin", "string"],
            "personnelles.tele" => ["required", "string"],
            "personnelles.addresse" => ["required", "string"]
        ];

        $vehiculeRules = [
            "vehicule.puissance_energie" => ["required", "string"],
            "vehicule.numero_immatriculation" => ["required", "string"],
            "vehicule.marque_type" => ["required", "string"],
            "vehicule.date_1er_mise_en" => ["required", "string"],
            "vehicule.poids_total_en_charge" => ["required", "numeric"],
            "vehicule.nombre_places" => ["required", "numeric"],
        ];

        $contratRules = [
            'contrat.du_date' => ["required", "date"],
            'contrat.au_date' => ["required", "date"],
            'contrat.montant_total' => ["required", "numeric"],
            'contrat.type_paiement' => ["required", "string"]
        ];

        if (request()->contrat["type_paiement"] === "Credit")
            $contratRules = array_merge($contratRules, [
                'contrat.montant_anticipe' => ["required", "numeric"],
                'contrat.montant_anticipe_type_paiement' => ["required", "in:Espece,Cheque,Virement"]
            ]);

        return array_merge(
            $clientRules,
            $vehiculeRules,
            $contratRules,
        );
    }
}
