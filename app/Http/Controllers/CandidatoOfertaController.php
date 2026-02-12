<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidatoOfertaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $modalidad = $request->get('modalidad');
        $ubicacion = $request->get('ubicacion');

        $ofertas = Oferta::query()
            ->when($search, fn($q) => $q->where('titulo', 'like', "%$search%"))
            ->when($modalidad, fn($q) => $q->where('modalidad', $modalidad))
            ->when($ubicacion, fn($q) => $q->where('ubicacion', 'like', "%$ubicacion%"))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('candidato.ofertas.index', compact('ofertas', 'search', 'modalidad', 'ubicacion'));
    }


    public function show(Oferta $oferta)
    {
        $candidato = Auth::user()->candidato;

        $inscrito = $oferta->inscripciones()
            ->where('candidato_id', $candidato->id)
            ->exists();

        return view('candidato.ofertas.show', compact('oferta', 'inscrito'));
    }
}
