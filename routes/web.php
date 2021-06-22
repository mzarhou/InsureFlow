<?php

use App\Http\Controllers\ChargeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ResiliationController;
use App\Models\Charge;
use App\Models\Contrat;
use App\Models\PaiementCredit;
use App\Models\Resiliation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $date = Carbon::now()->startOfDay();

    return Inertia::render("index", [
        'contrats' => Contrat::where("type_paiement", "!=", "Credit")->where("created_at", ">=", $date)->get(),
        'charges' => Charge::where("created_at", ">=", $date)->get(),
        'resiliations' => Resiliation::where("created_at", ">=", $date)->get(),
        'paiements' => PaiementCredit::where("created_at", ">=", $date)->get()
    ]);
})->middleware("auth")->name("index");

Route::get("/login", function () {
    return Inertia::render("Auth/Login");
})->middleware("guest")->name("login");


Route::middleware("auth")->group(function () {
    Route::resource("gestion-clients", ClientController::class)
        ->parameter("gestion-clients", "client")
        ->only("index", "create", "store", "show");
    Route::resource("gestion-charges", ChargeController::class)
        ->parameter("gestion-charges", "charge")
        ->only("index", "store", "update", "destroy");
    Route::resource("credit", CreditController::class)
        ->only("index", "show");

    Route::put("credit/{credit}/complete", [CreditController::class, "complete"])
        ->name("credit.complete");

    Route::resource("paiement", PaiementController::class)
        ->only("store");
    Route::resource("resiliation", ResiliationController::class)
        ->only("index", "store");
});
