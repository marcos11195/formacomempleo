<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;

class AdminEmpresaController extends Controller
{
    public function index()
    {
        return view('admin.empresas.index', [
            'empresas' => Empresa::all()
        ]);
    }

    public function show(Empresa $empresa)
    {
        return view('admin.empresas.show', compact('empresa'));
    }

    public function edit(Empresa $empresa)
    {
        return view('admin.empresas.edit', compact('empresa'));
    }

    public function update(Request $request, Empresa $empresa)
    {
        $empresa->update($request->all());
        return back()->with('success', 'Empresa actualizada');
    }
}
