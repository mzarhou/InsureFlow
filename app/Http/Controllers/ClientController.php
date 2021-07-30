<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Models\Contrat;
use App\Models\Credit;
use App\Models\PaiementCredit;
use App\Models\Vehicule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function index()
    {
        return Inertia::render("GestionClient/Index", [
            "clients" => fn () => Client::query()->when(request()->search, function ($query, $search) {
                return
                    $query->where("nom", "like", '%' . $search . '%')
                        ->orWhere("cin", "like", '%' . $search . '%')
                        ->orWhere("tele", "like", '%' . $search . '%');
            })
            ->paginate(10),
        ]);
    }

    public function create()
    {
        return Inertia::render("GestionClient/Create");
    }

    public function show($client_id)
    {
        $client = Client::query()->where("id", $client_id)
            ->with(["vehicules", "contrats.vehicule", "contrats.credit.paiements"])
            ->firstOrFail();
        return Inertia::render("GestionClient/Show", [
            "client" => $client
        ]);
    }

    public function store(StoreClientRequest $request)
    {
        DB::transaction(function () use ($request) {
            $client = $this->ajouter_client($request->input("personnelles"));
            $vehicule = $this->ajouter_vehicule($request->input("vehicule"), $client->id);
            $this->ajouter_contrat($request->input("contrat"), $vehicule->id);
            if ($request->contrat["type_paiement"] === "Credit")
                $this->ajouter_credit_paiement($request->input("contrat"), $vehicule->id);

        });

        return redirect()->route("gestion-clients.index")
            ->with("message", "succès");
    }

    private function ajouter_client($clientData): Client
    {
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

    private function ajouter_credit_paiement($contratData, $vehicule_id): PaiementCredit
    {
        $contrat = Contrat::create(array_merge($contratData, [
            "vehicule_id" => $vehicule_id
        ]));

        $credit = Credit::create([
            'contrat_id' => $contrat->id,
            'montant_total' => $contratData["montant_total"],
            'du' => Carbon::now(),
        ]);

        return PaiementCredit::create([
            'credit_id' => $credit->id,
            'montant' => $contratData["montant_anticipe"],
            'type_paiement' => $contratData['montant_anticipe_type_paiement'],
        ]);
    }
}
