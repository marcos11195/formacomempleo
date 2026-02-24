<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Storage;
use App\Models\Empresa;
use App\Models\Oferta;

class EmpresaDashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        abort_unless($user->role === UserRole::EMPRESA, 403);

        $empresa = $user->empresa;

        if (!$empresa) {
            return redirect()->route('empresa.complete');
        }

        $search = $request->get('search');
        $ofertasEmpresa = Oferta::where('idempresa', $empresa->id)
            ->when($search, function ($query, $search) {
                $query->where('titulo', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $ofertaSeleccionada = null;
        $inscritos = 0;

        if ($request->has('oferta')) {
            $ofertaSeleccionada = Oferta::where('idempresa', $empresa->id)
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

    public function edit()
    {
        $user = Auth::user();
        abort_unless($user->role === UserRole::EMPRESA, 403);
        $empresa = $user->empresa;
        return view('empresa.edit', compact('empresa'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        abort_unless($user->role === UserRole::EMPRESA, 403);
        $empresa = $user->empresa;

        $request->validate([
            'nombre' => 'required|string|max:255',
            'cif' => 'required|string|max:20',
            'telefono' => 'nullable|string|max:20',
            'web' => 'nullable|string|max:255',
            'persona_contacto' => 'nullable|string|max:255',
            'email_contacto' => 'required|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'cp' => 'nullable|string|max:10',
            'ciudad' => 'nullable|string|max:100',
            'provincia' => 'nullable|string|max:100',
            'logo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            if ($empresa->logo && Storage::disk('public')->exists(str_replace('storage/', '', $empresa->logo))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $empresa->logo));
            }

            $path = $request->file('logo')->store('images', 'public');
            $data['logo'] = 'storage/' . $path;
        }

        $empresa->update($data);

        return redirect()->route('empresa.dashboard')->with('flash.banner', 'Datos actualizados correctamente.');
    }
}
