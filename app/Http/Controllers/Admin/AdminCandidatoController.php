<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
use Illuminate\Http\Request;

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

    public function update(Request $request, Candidato $candidato)
    {
        $candidato->update($request->all());
        return back()->with('success', 'Candidato actualizado');
    }
}
