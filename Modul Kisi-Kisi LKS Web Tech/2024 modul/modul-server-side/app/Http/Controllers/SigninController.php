<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class SigninController extends Controller
{
    function signin(Request $request)
    {
        $request->validate([
            'username' => 'required|min:4|max:60',
            'password' => 'required|min:5|max:40',
        ]);

        $credentials = $request->only(['username', 'password']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = PersonalAccessToken::where('tokenable_id', $user->id)->where('name', 'signup-Token')->first();

            if (!$token) {
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Token tidak ada tolong register dulu'
                ], 401);
            }

            return response()->json([
                'status' => 'success',
                'token' => $token->token
            ]);
        }

        return response()->json([
            'status' => 'invalid',
            'message' => 'Wrong username or password'
        ], 401);
    }
}
