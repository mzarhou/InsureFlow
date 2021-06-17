<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
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

    public function store()
    {

    }
}
