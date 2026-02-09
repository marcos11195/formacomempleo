<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

class CandidatoController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        abort_unless($user->role === UserRole::CANDIDATO, 403);

        return view('candidato.dashboard');
    }
}
