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
            'cv' => 'nullable|mimes:pdf,doc,docx|max:10240',
        ]);

        $data = $request->all();

        // Guardar foto inicial
        if ($request->hasFile('foto')) {
            $pathFoto = $request->file('foto')->store('fotos', 'public');
            $data['foto'] = 'storage/' . $pathFoto;
        }

        // Guardar CV inicial
        if ($request->hasFile('cv')) {
            $pathCV = $request->file('cv')->store('cvs', 'public');
            $data['cv'] = 'storage/' . $pathCV;
        }

        $data['password_hash'] = Auth::user()->password;
        $candidato = Candidato::create($data);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->candidato_id = $candidato->id;
        $user->save();

        return redirect()->route('candidato.dashboard');
    }
}
