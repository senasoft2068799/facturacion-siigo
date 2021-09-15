<?php

use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\SucursaleController;
use App\Http\Controllers\BodegaController;
use App\Http\Controllers\CiudadeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::apiResource('documentos', DocumentoController::class);

Route::middleware('api')->group(function () {
    Route::apiResource('documentos', DocumentoController::class);
    Route::apiResource('sucursales', SucursaleController::class);
    Route::apiResource('bodegas', BodegaController::class);
    // Route::apiResource('ciudades', CiudadeController::class);
    Route::get("ciudades", [CiudadeController::class, "index"]);
});
