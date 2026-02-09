<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        abort_unless($user->role === UserRole::ADMIN, 403);

        $numUsers = User::count();

        return view('admin.dashboard', compact('numUsers'));
    }
}