<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        abort_unless($user->role === UserRole::ADMIN, 403);

        // Contar usuarios
        $numUsers = User::count();

        return view('admin.dashboard', compact('numUsers'));
    }
}
