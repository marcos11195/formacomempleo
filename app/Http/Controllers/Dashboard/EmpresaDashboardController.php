<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Enums\UserRole;

class EmpresaDashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        abort_unless($user->role === UserRole::EMPRESA, 403);

        $empresa = $user->empresa;

        // Búsqueda opcional
        $search = $request->get('search');

        $ofertasEmpresa = \App\Models\Oferta::where('idempresa', $empresa->id)
            ->when($search, function ($query, $search) {
                $query->where('titulo', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Oferta seleccionada
        $ofertaSeleccionada = null;
        $inscritos = 0;

        if ($request->has('oferta')) {
            $ofertaSeleccionada = \App\Models\Oferta::where('idempresa', $empresa->id)
                ->where('id', $request->oferta)
                ->first();

            if ($ofertaSeleccionada && method_exists($ofertaSeleccionada, 'inscripciones')) {
                $inscritos = $ofertaSeleccionada->inscripciones()->count();
            }
        }

        return view('empresa.dashboard', [
            'ofertasEmpresa' => $ofertasEmpresa,
            'ofertaSeleccionada' => $ofertaSeleccionada,
            'inscritos' => $inscritos,
            'search' => $search,
        ]);
    }



    // ⭐ FORMULARIO DE EDICIÓN
    public function edit()
    {
        $user = Auth::user();
        abort_unless($user->role === UserRole::EMPRESA, 403);

        $empresa = $user->empresa; // relación empresa del usuario

        return view('empresa.edit', compact('empresa'));
    }

    // ⭐ GUARDAR CAMBIOS
    public function update(Request $request)
    {
        $user = Auth::user();
        abort_unless($user->role === UserRole::EMPRESA, 403);

        $empresa = $user->empresa;

        // Validación
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        // Actualizar empresa
        $empresa->update($data);

        return redirect()
            ->route('empresa.dashboard')
            ->with('success', 'Datos de empresa actualizados correctamente.');
    }
}
