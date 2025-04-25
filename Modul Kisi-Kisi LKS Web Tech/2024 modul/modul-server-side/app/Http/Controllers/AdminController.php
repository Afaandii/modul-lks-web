<?php

namespace App\Http\Controllers;

use App\Models\Administrators;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Administrators::all();

        return Inertia::render("AdminList", [
            'admin' => $admin,
        ]);

        return response()->json([
            'totalElements' => $admin->count(),
            'content' => $admin
        ]);
    }
}
