<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Support\Facades\Auth;

class CandidatoInscripcionController extends Controller
{
    public function index()
    {
        $candidato = Auth::user()->candidato;

        // Ahora usamos la relación MANY-TO-MANY
        $inscripciones = $candidato->inscripciones()->with('empresa')->get();

        return view('candidato.inscripciones.index', compact('inscripciones'));
    }

    public function store(Oferta $oferta)
    {
        $candidato = Auth::user()->candidato;

        if ($candidato->inscripciones()->where('idoferta', $oferta->id)->exists()) {
            return back()->with('info', 'Ya estás inscrito en esta oferta.');
        }

        $candidato->inscripciones()->attach($oferta->id, [
            'fecha_inscripcion' => now(),
            'estado' => 'inscrito',
            'comentarios' => null,
        ]);

        return back()->with('success', 'Te has inscrito correctamente.');
    }

    public function destroy(Oferta $oferta)
    {
        $candidato = Auth::user()->candidato;

        $candidato->inscripciones()->detach($oferta->id);

        return back()->with('success', 'Te has desinscrito correctamente.');
    }
}
