<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Models\Sector;
use App\Models\Modalidad;
use App\Models\Puesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaOfertaController extends Controller
{
    public function index()
    {
        $empresa = Auth::user()->empresa;

        $ofertas = Oferta::where('idempresa', $empresa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('empresa.ofertas.index', compact('ofertas'));
    }

    public function create()
    {
        return view('empresa.ofertas.create', [
            'sectores' => Sector::all(),
            'modalidades' => Modalidad::all(),
            'puestos' => Puesto::all(),
        ]);
    }

    public function store(Request $request)
    {
        $empresa = Auth::user()->empresa;

        $data = $request->validate([
            'idsector' => 'required|exists:sectores,id',
            'idmodalidad' => 'required|exists:modalidad,id',
            'idpuesto' => 'required|exists:puestos,id',
            'titulo' => 'required|string|max:200',
            'descripcion' => 'required|string',
            'requisitos' => 'nullable|string',
            'funciones' => 'nullable|string',
            'salario_min' => 'nullable|numeric',
            'salario_max' => 'nullable|numeric',
            'tipo_contrato' => 'nullable|string|max:100',
            'jornada' => 'nullable|string|max:100',
            'ubicacion' => 'nullable|string|max:150',
            'fecha_publicacion' => 'nullable|date',
            'publicar_hasta' => 'nullable|date',
            'fecha_incorporacion' => 'nullable|date',
            'estado' => 'required|in:borrador,publicada,pausada,cerrada,vencida',
        ]);

        $data['idempresa'] = $empresa->id;

        Oferta::create($data);

        return redirect()->route('ofertas.index')
            ->with('success', 'Oferta creada correctamente.');
    }

    public function edit(Oferta $oferta)
    {
        $this->authorizeOferta($oferta);

        return view('empresa.ofertas.edit', [
            'oferta' => $oferta,
            'sectores' => Sector::all(),
            'modalidades' => Modalidad::all(),
            'puestos' => Puesto::all(),
        ]);
    }

    public function update(Request $request, Oferta $oferta)
    {
        $this->authorizeOferta($oferta);

        $data = $request->validate([
            'idsector' => 'required|exists:sectores,id',
            'idmodalidad' => 'required|exists:modalidad,id',
            'idpuesto' => 'required|exists:puestos,id',
            'titulo' => 'required|string|max:200',
            'descripcion' => 'required|string',
            'requisitos' => 'nullable|string',
            'funciones' => 'nullable|string',
            'salario_min' => 'nullable|numeric',
            'salario_max' => 'nullable|numeric',
            'tipo_contrato' => 'nullable|string|max:100',
            'jornada' => 'nullable|string|max:100',
            'ubicacion' => 'nullable|string|max:150',
            'fecha_publicacion' => 'nullable|date',
            'publicar_hasta' => 'nullable|date',
            'fecha_incorporacion' => 'nullable|date',
            'estado' => 'required|in:borrador,publicada,pausada,cerrada,vencida',
        ]);

        $oferta->update($data);

        return redirect()->route('ofertas.index')
            ->with('success', 'Oferta actualizada correctamente.');
    }

    public function destroy(Oferta $oferta)
    {
        $this->authorizeOferta($oferta);

        $oferta->delete();

        return redirect()->route('ofertas.index')
            ->with('success', 'Oferta eliminada.');
    }

    private function authorizeOferta(Oferta $oferta)
    {
        abort_unless($oferta->idempresa === Auth::user()->empresa_id, 403);
    }
    public function show(Oferta $oferta)
    {
        $this->authorizeOferta($oferta);

        $empresa = Auth::user()->empresa;

        // Todas las ofertas de la empresa (para el menú lateral o tarjetas)
        $ofertasEmpresa = Oferta::where('idempresa', $empresa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Si tienes relación inscripciones()
        $inscritos = method_exists($oferta, 'inscripciones')
            ? $oferta->inscripciones()->count()
            : 0;

        return view('empresa.ofertas.show', [
            'oferta' => $oferta,
            'ofertasEmpresa' => $ofertasEmpresa,
            'inscritos' => $inscritos,
        ]);
    }
}
