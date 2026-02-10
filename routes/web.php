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

        // EMPRESA → si no tiene empresa asociada, completar perfil
        if ($user->role === UserRole::EMPRESA && $user->empresa_id === null) {
            return redirect()->route('empresa.complete');
        }

        // CANDIDATO → si no tiene candidato asociado, completar perfil
        if ($user->role === UserRole::CANDIDATO && $user->candidato_id === null) {
            return redirect()->route('candidato.complete');
        }

        // Si ya completó el perfil → dashboard normal
        return match ($user->role) {
            UserRole::ADMIN => redirect()->route('admin.dashboard'),
            UserRole::EMPRESA => redirect()->route('empresa.dashboard'),
            UserRole::CANDIDATO => redirect()->route('candidato.dashboard'),
            default => abort(403),
        };
    })->name('dashboard');

    // ⭐ DASHBOARDS NORMALES (solo si el perfil está completo)
    Route::get('/admin', [AdminDashboardController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/empresa', [EmpresaDashboardController::class, 'dashboard'])
        ->name('empresa.dashboard');

    Route::get('/candidato', [CandidatoDashboardController::class, 'dashboard'])
        ->name('candidato.dashboard');
});
