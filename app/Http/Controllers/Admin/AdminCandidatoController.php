<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCandidatoController extends Controller
{
    public function index()
    {
        return view('admin.candidatos.index', [
            'candidatos' => Candidato::all()
        ]);
    }

    public function show(Candidato $candidato)
    {
        return view('admin.candidatos.show', compact('candidato'));
    }

    public function edit(Candidato $candidato)
    {
        return view('admin.candidatos.edit', compact('candidato'));
    }

    public function update(Request $request, Candidato $candidato)
    {
        $data = $request->all();

        // Asumimos que el campo se llama 'foto' (ajusta si es 'avatar' o similar)
        if ($request->hasFile('foto')) {

            // 1. Borrar foto antigua si existe
            if ($candidato->foto && Storage::disk('public')->exists(str_replace('storage/', '', $candidato->foto))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $candidato->foto));
            }

            // 2. Guardar nueva foto en app/public/images
            $path = $request->file('foto')->store('images', 'public');

            // 3. Formatear ruta para la vista
            $data['foto'] = 'storage/' . $path;
        }

        $candidato->update($data);

        return redirect()->route('admin.candidatos.show', $candidato)
            ->with('success', 'Candidato actualizado correctamente');
    }
}
