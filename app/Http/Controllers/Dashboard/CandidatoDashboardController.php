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

        $data = $request->validate([
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
            'cv' => 'nullable|mimes:pdf,doc,docx|max:20480',

        ]);

        // FOTO
        if ($request->hasFile('foto')) {

            // Borrar foto anterior
            if ($candidato->foto && file_exists(public_path($candidato->foto))) {
                unlink(public_path($candidato->foto));
            }

            $filenameFoto = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('fotos'), $filenameFoto);

            $data['foto'] = 'fotos/' . $filenameFoto;
        }

        // CV
        if ($request->hasFile('cv')) {

            // Borrar CV anterior
            if ($candidato->cv && file_exists(public_path($candidato->cv))) {
                unlink(public_path($candidato->cv));
            }

            $filenameCV = time() . '_' . $request->file('cv')->getClientOriginalName();
            $request->file('cv')->move(public_path('cv'), $filenameCV);

            $data['cv'] = 'cv/' . $filenameCV;
        }

        $candidato->update($data);

        return redirect()
            ->route('candidato.dashboard')
            ->with('success', 'Datos de candidato actualizados correctamente.');
    }
}
