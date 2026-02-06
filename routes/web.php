<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

Route::get('/', function () {
    return view('welcome');
});

// Grupo principal de Jetstream
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // ADMIN
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/admin', function () {
            $user = Auth::user();
            abort_unless($user->role === UserRole::ADMIN, 403);
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    // EMPRESA
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/empresa', function () {
            $user = Auth::user();
            abort_unless($user->role === UserRole::EMPRESA, 403);
            return view('empresa.dashboard');
        })->name('empresa.dashboard');
    });

    // CANDIDATO
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/candidato', function () {
            $user = Auth::user();
            abort_unless($user->role === UserRole::CANDIDATO, 403);
            return view('candidato.dashboard');
        })->name('candidato.dashboard');
    });

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
