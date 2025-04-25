<?php

namespace App\Http\Controllers;

use App\Models\Regionals;
use App\Models\Societies;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'id_card_number' => 'required|max:200',
            'password' => 'required|max:200'
        ]);

        $credentials = Societies::where('id_card_number', $request->input('id_card_number'))->where('password', $request->input('password'))->first();

        if(!$credentials){
            return response()->json([
                'message' => 'ID Card Number or password incorrect',
            ], 401);
        }

        $token = $credentials->createToken('login_token')->plainTextToken;

        $societies = Societies::create([
            'id_card_number' => $request->input('id_card_number'),
            'password' => $request->input('password'),
            'login_tokens' => $token
        ]);

        $regional = Regionals::where('id', $societies->regional_id);

        return response()->json([
            $societies,
            "regional" => [
                $regional
            ]
        ], 200);
    }

    public function logout($token){
        $societies = Societies::where('login_tokens', $token)->first();

        if(!$societies){
            return response()->json([
                'message' => 'Invalid Token'
            ], 401);
        }

        $societies->update(['login_tokens' => null]);

        return response()->json([
            'message' => 'Logout Success'
        ], 200);
    }
}
