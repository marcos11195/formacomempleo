<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controladores REST
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EmpresaOfertaController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\ModalidadController;
use App\Http\Controllers\SectorController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ⭐ RUTAS API REST
Route::apiResource('empresas', EmpresaController::class);
// Route::apiResource('ofertas', EmpresaOfertaController::class);
Route::apiResource('candidatos', CandidatoController::class);
Route::apiResource('puestos', PuestoController::class);
Route::apiResource('modalidad', ModalidadController::class);
Route::apiResource('sectores', SectorController::class);
