<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Enums\UserRole;

class CandidatoDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        abort_unless($user->role === UserRole::CANDIDATO, 403);

        return view('candidato.dashboard');
    }

    // ⭐ FORMULARIO DE EDICIÓN
    public function edit()
    {
        $user = Auth::user();
        abort_unless($user->role === UserRole::CANDIDATO, 403);

        $candidato = $user->candidato; // relación candidato del usuario

        return view('candidato.edit', compact('candidato'));
    }

    // ⭐ GUARDAR CAMBIOS
    public function update(Request $request)
    {
        $user = Auth::user();
        abort_unless($user->role === UserRole::CANDIDATO, 403);

        $candidato = $user->candidato;

        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $candidato->update($data);

        return redirect()
            ->route('candidato.dashboard')
            ->with('success', 'Datos de candidato actualizados correctamente.');
    }
}
