<?php

use App\Http\Controllers\ChargeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\PaiementController;
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
    return Inertia::render("index");
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

    Route::resource("paiement", PaiementController::class)
        ->only("store");
});
