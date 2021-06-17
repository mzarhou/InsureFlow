<?php

use App\Http\Controllers\ClientController;
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


Route::resource("gestion-client", ClientController::class)->middleware("auth")
    ->only("index", "create", "store");
