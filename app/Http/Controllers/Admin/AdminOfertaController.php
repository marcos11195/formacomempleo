<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Oferta;
use Illuminate\Http\Request;

class AdminOfertaController extends Controller
{
    public function index()
    {
        return view('admin.ofertas.index', [
            'ofertas' => Oferta::with('empresa')->get()
        ]);
    }

    public function show(Oferta $oferta)
    {
        return view('admin.ofertas.show', compact('oferta'));
    }

    public function edit(Oferta $oferta)
    {
        return view('admin.ofertas.edit', compact('oferta'));
    }

    public function update(Request $request, Oferta $oferta)
    {
        $oferta->update($request->all());
        return redirect()->route('admin.ofertas.show', $oferta)
            ->with('success', 'Oferta actualizada correctamente.');
    }
}
