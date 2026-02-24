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
            'logo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('images', 'public');
            $data['logo'] = 'storage/' . $path;
        }

        $data['idusuario'] = Auth::id();
        $data['verificada'] = false;

        $empresa = Empresa::create($data);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->empresa_id = $empresa->id;
        $user->save();

        return redirect()->route('empresa.dashboard')->with('flash.banner', 'Perfil de empresa creado correctamente.');
    }
}
