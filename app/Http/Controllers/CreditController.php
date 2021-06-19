<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("Credit/Index", [
            "credits" => fn () => Credit::with(["contrat.vehicule.client", "paiements"])
                ->when(request()->search, function (Builder $query, $search) {
                    return $query->whereHas("contrat.vehicule.client", function (Builder $query) use ($search) {
                        $query->where("nom", "like", '%' . $search . '%')
                            ->orWhere("cin", "like", '%' . $search . '%');
                    });
                })
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function show($credit_id)
    {
        $credit = Credit::query()->where("id", $credit_id)
            ->with(["paiements", "contrat.vehicule"])
            ->firstOrFail();

        return Inertia::render("Credit/Show", [
            "credit" => $credit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function edit(Credit $credit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Credit $credit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Credit $credit)
    {
        //
    }
}
