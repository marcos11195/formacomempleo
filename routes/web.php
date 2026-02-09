<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\CandidatoController;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;

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

// Grupo principal de Jetstream (solo usuarios logueados)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // ADMIN
    Route::get('/admin', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // EMPRESA
    Route::get('/empresa', [EmpresaController::class, 'dashboard'])
        ->name('empresa.dashboard');

    // CANDIDATO
    Route::get('/candidato', [CandidatoController::class, 'dashboard'])
        ->name('candidato.dashboard');

    // RUTA QUE JETSTREAM NECESITA
    Route::get('/dashboard', function () {
        $user = Auth::user();

        return match ($user->role) {
            UserRole::ADMIN => redirect()->route('admin.dashboard'),
            UserRole::EMPRESA => redirect()->route('empresa.dashboard'),
            UserRole::CANDIDATO => redirect()->route('candidato.dashboard'),
            default => abort(403),
        };
    })->name('dashboard');

});
