<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    function signout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['status' => 'logout success']);
    }
}
