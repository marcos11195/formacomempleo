<?php
namespace App\Http\Controllers;

use App\Models\Modalidad;
use Illuminate\Http\Request;

class ModalidadController extends Controller
{
    public function index()
    {
        return Modalidad::all();
    }

    public function store(Request $request)
    {
        return Modalidad::create($request->all());
    }

    public function show(Modalidad $modalidad)
    {
        return $modalidad->load('ofertas');
    }

    public function update(Request $request, Modalidad $modalidad)
    {
        $modalidad->update($request->all());
        return $modalidad;
    }

    public function destroy(Modalidad $modalidad)
    {
        $modalidad->delete();
        return response()->json(['message' => 'Modalidad eliminada']);
    }
}
