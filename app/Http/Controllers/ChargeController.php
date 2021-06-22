<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("GestionCharges/Index", [
            "charges" => Charge::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "montant" => ["required", "numeric"],
            "description" => ["required", "string"]
        ]);

        Charge::create($request->only("montant", "description"));

        return redirect()->route("gestion-charges.index")
            ->with("message", "succès");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Charge  $charge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Charge $charge)
    {
        $request->validate([
            "montant" => ["required", "numeric"],
            "description" => ["required", "string"]
        ]);

        $charge->update($request->all());

        return redirect()->route("gestion-charges.index")
            ->with("message", "succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Charge  $charge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Charge $charge)
    {
        $charge->delete();
        return redirect()->route("gestion-charges.index")
            ->with("message", "succès");
    }
}
