<?php

use Illuminate\Support\Facades\Route;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;

// Controladores de dashboard
use App\Http\Controllers\Dashboard\AdminDashboardController;
use App\Http\Controllers\Dashboard\EmpresaDashboardController;
use App\Http\Controllers\Dashboard\CandidatoDashboardController;

// Controladores para completar perfil
use App\Http\Controllers\Dashboard\EmpresaProfileController;
use App\Http\Controllers\Dashboard\CandidatoProfileController;

// Controlador de ofertas (EMPRESA)
use App\Http\Controllers\EmpresaOfertaController;

// Controladores del CANDIDATO
use App\Http\Controllers\CandidatoOfertaController;
use App\Http\Controllers\CandidatoInscripcionController;

Route::get('/', function () {
    return view('welcome');
});

// ⭐ RUTAS DE REGISTRO PERSONALIZADO (PÚBLICAS)
Route::get('/register/empresa', function () {
    return view('auth.register', ['role' => 'empresa']);
})->name('register.empresa');

Route::get('/register/candidato', function () {
    return view('auth.register', ['role' => 'candidato']);
})->name('register.candidato');

// ⭐ GRUPO PRINCIPAL DE JETSTREAM (solo usuarios logueados)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // ⭐ RUTAS PARA COMPLETAR PERFIL (ANTES DEL DASHBOARD)
    Route::get('/empresa/complete', [EmpresaProfileController::class, 'showForm'])
        ->name('empresa.complete');

    Route::post('/empresa/complete', [EmpresaProfileController::class, 'store']);

    Route::get('/candidato/complete', [CandidatoProfileController::class, 'showForm'])
        ->name('candidato.complete');

    Route::post('/candidato/complete', [CandidatoProfileController::class, 'store']);

    // ⭐ RUTA CENTRAL DE REDIRECCIÓN DESPUÉS DEL LOGIN
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->role === UserRole::EMPRESA && $user->empresa_id === null) {
            return redirect()->route('empresa.complete');
        }

        if ($user->role === UserRole::CANDIDATO && $user->candidato_id === null) {
            return redirect()->route('candidato.complete');
        }

        return match ($user->role) {
            UserRole::ADMIN => redirect()->route('admin.dashboard'),
            UserRole::EMPRESA => redirect()->route('empresa.dashboard'),
            UserRole::CANDIDATO => redirect()->route('candidato.dashboard'),
            default => abort(403),
        };
    })->name('dashboard');

    // ⭐ DASHBOARDS NORMALES
    Route::get('/admin', [AdminDashboardController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/empresa', [EmpresaDashboardController::class, 'dashboard'])
        ->name('empresa.dashboard');

    Route::get('/candidato', [CandidatoDashboardController::class, 'dashboard'])
        ->name('candidato.dashboard');

    // ⭐⭐⭐ RUTAS DE EDITAR EMPRESA ⭐⭐⭐
    Route::get('/empresa/editar', [EmpresaDashboardController::class, 'edit'])
        ->name('empresa.edit');

    Route::put('/empresa/editar', [EmpresaDashboardController::class, 'update'])
        ->name('empresa.update');

    // ⭐⭐⭐ RUTAS DE EDITAR CANDIDATO ⭐⭐⭐
    Route::get('/candidato/editar', [CandidatoDashboardController::class, 'edit'])
        ->name('candidato.edit');

    Route::post('/candidato/editar', [CandidatoDashboardController::class, 'update'])
        ->name('candidato.update');

    // ⭐⭐⭐ RUTAS DE OFERTAS PROFESIONALES (EMPRESA) ⭐⭐⭐
    Route::prefix('empresa/ofertas')->group(function () {

        Route::get('/', [EmpresaOfertaController::class, 'index'])
            ->name('ofertas.index');

        Route::get('/crear', [EmpresaOfertaController::class, 'create'])
            ->name('ofertas.create');

        Route::post('/crear', [EmpresaOfertaController::class, 'store'])
            ->name('ofertas.store');

        Route::get('/{oferta}', [EmpresaOfertaController::class, 'show'])
            ->name('empresa.ofertas.show');

        Route::get('/{oferta}/editar', [EmpresaOfertaController::class, 'edit'])
            ->name('ofertas.edit');

        Route::put('/{oferta}/editar', [EmpresaOfertaController::class, 'update'])
            ->name('ofertas.update');

        Route::delete('/{oferta}', [EmpresaOfertaController::class, 'destroy'])
            ->name('ofertas.destroy');
    });

    // ⭐⭐⭐ RUTAS DEL CANDIDATO ⭐⭐⭐
    Route::prefix('candidato')->group(function () {

        // Buscar ofertas
        Route::get('/ofertas', [CandidatoOfertaController::class, 'index'])
            ->name('candidato.ofertas.index');

        // Ver oferta
        Route::get('/ofertas/{oferta}', [CandidatoOfertaController::class, 'show'])
            ->name('candidato.ofertas.show');

        // Inscribirse (usa ofertas_candidatos)
        Route::post('/ofertas/{oferta}/inscribirse', [CandidatoInscripcionController::class, 'store'])
            ->name('candidato.inscribirse');

        // Desinscribirse (usa ofertas_candidatos)
        Route::delete('/ofertas/{oferta}/desinscribirse', [CandidatoInscripcionController::class, 'destroy'])
            ->name('candidato.desinscribirse');

        // Listado de inscripciones (usa ofertas_candidatos)
        Route::get('/inscripciones', [CandidatoInscripcionController::class, 'index'])
            ->name('candidato.inscripciones');
    });
});
