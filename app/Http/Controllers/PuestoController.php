<?php
namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;

class PuestoController extends Controller
{
    public function index()
    {
        return Puesto::all();
    }

    public function store(Request $request)
    {
        return Puesto::create($request->all());
    }

    public function show(Puesto $puesto)
    {
        return $puesto->load('ofertas');
    }

    public function update(Request $request, Puesto $puesto)
    {
        $puesto->update($request->all());
        return $puesto;
    }

    public function destroy(Puesto $puesto)
    {
        $puesto->delete();
        return response()->json(['message' => 'Puesto eliminado']);
    }
}
