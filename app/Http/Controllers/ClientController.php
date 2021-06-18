<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contrat;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::query()->paginate(10);
        return Inertia::render("GestionClient/Index", [
            "clients" => $clients,
        ]);
    }

    public function create()
    {
        return Inertia::render("GestionClient/Create");
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $client = $this->ajouter_client($request->input("personnelles"));
            $vehicule = $this->ajouter_vehicule($request->input("vehicule"), $client->id);
            $this->ajouter_contrat($request->input("contrat"), $vehicule->id);
        });

        return redirect()->route("gestion-clients.index");
    }

    private function ajouter_client($clientData): Client
    {
        Validator::make($clientData, [
            "nom" => ["required", "string", "min:3"],
            "cin" => ["required", "unique:clients,cin", "string"],
            "tele" => ["required", "string"],
            "addresse" => ["required", "string"],
        ])->validate();

        return Client::create($clientData);
    }

    private function ajouter_vehicule($vehiculeData, $client_id): Vehicule
    {
        return Vehicule::create(array_merge($vehiculeData, [
            "client_id" => $client_id
        ]));
    }

    private function ajouter_contrat($contratData, $vehicule_id): Contrat
    {
        return Contrat::create(array_merge($contratData, [
            "vehicule_id" => $vehicule_id
        ]));
    }
}
