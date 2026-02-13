<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidato;
use Illuminate\Support\Facades\Auth;

class CandidatoProfileController extends Controller
{
    public function showForm()
    {
        return view('candidato.complete-profile');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|string|max:20',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'direccion' => 'nullable|string|max:255',
            'cp' => 'nullable|string|max:10',
            'ciudad' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'web' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:4096',
        ]);

        // ⭐ AHORA SÍ INCLUYE CV Y FOTO
        $data = $request->only([
            'dni',
            'nombre',
            'apellidos',
            'telefono',
            'email',
            'fecha_nacimiento',
            'direccion',
            'cp',
            'ciudad',
            'provincia',
            'linkedin',
            'web',
            'foto',
            'cv'
        ]);

        // Guardar foto
        if ($request->hasFile('foto')) {
            $filenameFoto = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('fotos'), $filenameFoto);
            $data['foto'] = 'fotos/' . $filenameFoto;
        }

        // Guardar CV
        if ($request->hasFile('cv')) {
            $filenameCV = time() . '_' . $request->file('cv')->getClientOriginalName();
            $request->file('cv')->move(public_path('cv'), $filenameCV);
            $data['cv'] = 'cv/' . $filenameCV;
        }

        // Crear candidato
        $data['password_hash'] = Auth::user()->password;

        $candidato = Candidato::create($data);
        /** @var \App\Models\User $user */

        $user = Auth::user();
        $user->candidato_id = $candidato->id;
        $user->save();

        return redirect()->route('candidato.dashboard');
    }
}
