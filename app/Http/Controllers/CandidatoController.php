<?php
namespace App\Http\Controllers;

use App\Models\Candidato;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    public function index()
    {
        return Candidato::all();
    }

    public function store(Request $request)
    {
        return Candidato::create($request->all());
    }

    public function show(Candidato $candidato)
    {
        return $candidato->load('ofertas');
    }

    public function update(Request $request, Candidato $candidato)
    {
        $candidato->update($request->all());
        return $candidato;
    }

    public function destroy(Candidato $candidato)
    {
        $candidato->delete();
        return response()->json(['message' => 'Candidato eliminado']);
    }
}
