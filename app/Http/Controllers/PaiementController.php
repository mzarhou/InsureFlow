<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaiementRequest;
use App\Models\Credit;
use App\Models\PaiementCredit;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaiementRequest $request)
    {
        if (($response = $this->storeCheck($request)) != null)
            return $response;
        PaiementCredit::create($request->only("montant", "credit_id", "type_paiement"));
        return redirect()->route("credit.show", $request->credit_id)
            ->with("message", "succès");
    }

    protected function storeCheck(Request $request)
    {
        $credit = Credit::query()->findOrFail($request->credit_id);
        $paiements = $credit->paiements->pluck("montant");
        $paid_amount = (function () use ($paiements) {
            $total = 0;
            foreach ($paiements as $paiement) {
                $total += $paiement;
            }
            return $total;
        })();

        $credit_rest_amount = $credit->montant_total - $paid_amount;

        if ($request->montant > $credit_rest_amount)
            return response('', 409);
        else if (!!$credit->completed)
            return response('', 403);
    }
}
