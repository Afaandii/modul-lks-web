<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    function signup(Request $request, User $user)
    {
        // dd('berhasil ke signup');
        $request->validate([
            'username' => 'required|unique:users,username|min:4|max:60',
            'password' => 'required|min:5|max:40',
        ]);

        $user = User::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
        ]);

        $token = $user->createToken('signup-Token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'token' => $token
        ], 201);
    }
}
