<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = Empresa::all();
        return view('admin.empresas.index', compact('empresas'));
    }

    public function store(Request $request)
    {
        return Empresa::create($request->all());
    }

    public function show(Empresa $empresa)
    {
        return view('admin.empresas.show', compact('empresa'));
    }

    public function update(Request $request, Empresa $empresa)
    {
        $request->validate([
            'nombre' => 'required',
            'logo' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            // 1. Borrar el logo antiguo (usando la lógica del Admin)
            if ($empresa->logo && Storage::disk('public')->exists(str_replace('storage/', '', $empresa->logo))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $empresa->logo));
            }

            // 2. Guardar el nuevo logo en 'images' dentro del disco 'public'
            $path = $request->file('logo')->store('images', 'public');

            // 3. CLAVE: Guardar con el prefijo 'storage/' igual que hace el Admin
            $data['logo'] = 'storage/' . $path;
        }

        $empresa->update($data);

        return back()->with('flash.banner', '¡Empresa actualizada correctamente!');
    }

    public function destroy(Empresa $empresa)
    {
        $empresa->delete();
        return response()->json(['message' => 'Empresa eliminada']);
    }
}
