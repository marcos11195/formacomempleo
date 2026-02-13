<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfertaCandidato;

class AdminInscripcionController extends Controller
{
    public function index()
    {
        return view('admin.inscripciones.index', [
            'inscripciones' => OfertaCandidato::with(['candidato', 'oferta'])->get()
        ]);
    }

    public function show($idoferta, $idcandidato)
    {
        $inscripcion = OfertaCandidato::with(['candidato', 'oferta'])
            ->where('idoferta', $idoferta)
            ->where('idcandidato', $idcandidato)
            ->firstOrFail();

        return view('admin.inscripciones.show', compact('inscripcion'));
    }
}
