<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Storage;
use App\Models\Candidato;

class CandidatoDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        abort_unless($user->role === UserRole::CANDIDATO, 403);
        return view('candidato.dashboard');
    }

    public function edit()
    {
        $user = Auth::user();
        abort_unless($user->role === UserRole::CANDIDATO, 403);
        $candidato = $user->candidato;
        return view('candidato.edit', compact('candidato'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        abort_unless($user->role === UserRole::CANDIDATO, 403);
        $candidato = $user->candidato;

        $request->validate([
            'dni' => 'nullable|string|max:20',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'direccion' => 'nullable|string|max:255',
            'cp' => 'nullable|string|max:10',
            'ciudad' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'web' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:10240',
        ]);

        $data = $request->all();

        // Gestión de FOTO
        if ($request->hasFile('foto')) {
            if ($candidato->foto && Storage::disk('public')->exists(str_replace('storage/', '', $candidato->foto))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $candidato->foto));
            }
            $pathFoto = $request->file('foto')->store('fotos', 'public');
            $data['foto'] = 'storage/' . $pathFoto;
        }

        // Gestión de CV
        if ($request->hasFile('cv')) {
            if ($candidato->cv && Storage::disk('public')->exists(str_replace('storage/', '', $candidato->cv))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $candidato->cv));
            }
            $pathCV = $request->file('cv')->store('cvs', 'public');
            $data['cv'] = 'storage/' . $pathCV;
        }

        $candidato->update($data);

        return redirect()->route('candidato.dashboard')
            ->with('flash.banner', 'Perfil actualizado correctamente.');
    }
}
