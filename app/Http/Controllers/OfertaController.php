<?php
namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;

class OfertaController extends Controller
{
    public function index()
    {
        return Oferta::with(['empresa','sector','modalidad','puesto'])->get();
    }

    public function store(Request $request)
    {
        return Oferta::create($request->all());
    }

    public function show(Oferta $oferta)
    {
        return $oferta->load(['empresa','sector','modalidad','puesto','candidatos']);
    }

    public function update(Request $request, Oferta $oferta)
    {
        $oferta->update($request->all());
        return $oferta;
    }

    public function destroy(Oferta $oferta)
    {
        $oferta->delete();
        return response()->json(['message' => 'Oferta eliminada']);
    }
}
