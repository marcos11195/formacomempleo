<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

class EmpresaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        abort_unless($user->role === UserRole::EMPRESA, 403);

        return view('empresa.dashboard');
    }
}
