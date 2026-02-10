<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;

class EmpresaProfileController extends Controller
{
    public function showForm()
    {
        return view('empresa.complete-profile');
    }

   public function store(Request $request)
{
    $request->validate([
        'cif' => 'required|string|max:20',
        'nombre' => 'required|string|max:255',
        'telefono' => 'nullable|string|max:20',
        'web' => 'nullable|string|max:255',
        'persona_contacto' => 'nullable|string|max:255',
        'email_contacto' => 'required|email|max:255',
        'direccion' => 'nullable|string|max:255',
        'cp' => 'nullable|string|max:10',
        'ciudad' => 'nullable|string|max:255',
        'provincia' => 'nullable|string|max:255',
        'logo' => 'nullable|image|max:2048', // 2MB
    ]);

    $logoPath = null;

    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('logos', 'public');
    }

    $empresa = Empresa::create([
        'cif' => $request->cif,
        'nombre' => $request->nombre,
        'telefono' => $request->telefono,
        'web' => $request->web,
        'persona_contacto' => $request->persona_contacto,
        'email_contacto' => $request->email_contacto,
        'direccion' => $request->direccion,
        'cp' => $request->cp,
        'ciudad' => $request->ciudad,
        'provincia' => $request->provincia,
        'logo' => $logoPath,
        'verificada' => false, // solo admin
    ]);
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->empresa_id = $empresa->id;
        $user->save();

        return redirect()->route('empresa.dashboard');
    }
}
