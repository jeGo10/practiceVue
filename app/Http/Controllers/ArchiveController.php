<?php

// app/Http/Controllers/ArchiveController.php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArchiveController extends Controller
{
    public function index()
    {
        return Inertia::render('Archive/Index', [
            
        ]);
    }

}
