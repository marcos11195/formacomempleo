<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminEmpresaController extends Controller
{
    public function index()
    {
        return view('admin.empresas.index', [
            'empresas' => Empresa::all()
        ]);
    }

    public function show(Empresa $empresa)
    {
        return view('admin.empresas.show', compact('empresa'));
    }

    public function edit(Empresa $empresa)
    {
        return view('admin.empresas.edit', compact('empresa'));
    }

    public function update(Request $request, Empresa $empresa)
    {
        $data = $request->all();

        // Verificamos si se ha subido un archivo nuevo
        if ($request->hasFile('logo')) {

            // 1. Borrar el logo antiguo del disco si existe para no dejar basura
            if ($empresa->logo && Storage::disk('public')->exists(str_replace('storage/', '', $empresa->logo))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $empresa->logo));
            }

            // 2. Guardar el nuevo logo en app/public/images
            $path = $request->file('logo')->store('images', 'public');

            // 3. Guardar la ruta con el prefijo 'storage/' para las vistas
            $data['logo'] = 'storage/' . $path;
        }

        $empresa->update($data);

        // Redirigimos a show en lugar de back para confirmar los cambios visualmente
        return redirect()->route('admin.empresas.show', $empresa)
            ->with('success', 'Empresa actualizada correctamente');
    }
}
