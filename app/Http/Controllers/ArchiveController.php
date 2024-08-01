<?php

// app/Http/Controllers/ArchiveController.php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ArchiveController extends Controller
{
    public function index()
    {
        $user = User::with('roles')->find(Auth::id());

        return Inertia::render('Archive/Index', [
            'auth' => [
                'user' => $user
            ]
        ]);
    }

}
