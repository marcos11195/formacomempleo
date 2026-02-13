<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Empresa;
use App\Models\Candidato;
use App\Models\Oferta;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'numUsers' => User::count(),
            'numEmpresas' => Empresa::count(),
            'numCandidatos' => Candidato::count(),
            'numOfertas' => Oferta::count(),
        ]);
    }
}
