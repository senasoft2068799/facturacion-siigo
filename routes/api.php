<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\SucursaleController;
use App\Http\Controllers\BodegaController;
use App\Http\Controllers\CiudadeController;
use App\Http\Controllers\DetalleFacturaController;
use App\Http\Controllers\DetalleMovimientoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
Route::post("register", [AuthController::class, "register"]);
Route::post("login", [AuthController::class, "login"]);
Route::post("logout", [AuthController::class, "logout"])->middleware("auth:sanctum");

Route::middleware('api')->group(function () {
    // Route::get("permisos", [PermisoController::class, "index"]);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('users', UserController::class);
    Route::get("ciudades", [CiudadeController::class, "index"]);
    Route::apiResource('sucursales', SucursaleController::class);
    Route::apiResource('documentos', DocumentoController::class);
    Route::apiResource('bodegas', BodegaController::class);
    Route::apiResource('facturas', FacturaController::class);
    Route::apiResource('movimientos', MovimientoController::class);
    Route::apiResource('detalle-movimientos', DetalleMovimientoController::class);
    Route::post("detalle-facturas", [DetalleFacturaController::class, "store"]);
    Route::put("detalle-facturas/{detalle_movimiento}", [DetalleFacturaController::class, "update"]);
    Route::apiResource('categorias', CategoriaController::class);
    Route::apiResource('productos', ProductoController::class);
    // Route::apiResource('ciudades', CiudadeController::class);
    Route::post("import-excel-productos", [ProductoController::class, "importExcel"]);
    Route::get("unread-notifications", [AuthController::class, "unreadNotifications"]);
    Route::get("mark-as-read", [AuthController::class, "markAsRead"]);
});
