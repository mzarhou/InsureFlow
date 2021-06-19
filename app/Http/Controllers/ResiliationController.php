<?php

namespace App\Http\Controllers;

use App\Models\Resiliation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ResiliationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("Resiliation/Index", [
            "resiliations" => fn () => Resiliation::with(["contrat.vehicule.client"])
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
     * @param  \App\Models\Resiliation  $resiliation
     * @return \Illuminate\Http\Response
     */
    public function show(Resiliation $resiliation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resiliation  $resiliation
     * @return \Illuminate\Http\Response
     */
    public function edit(Resiliation $resiliation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resiliation  $resiliation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resiliation $resiliation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resiliation  $resiliation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resiliation $resiliation)
    {
        //
    }
}
