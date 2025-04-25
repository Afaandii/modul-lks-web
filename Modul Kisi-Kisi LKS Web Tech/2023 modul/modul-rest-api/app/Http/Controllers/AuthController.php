<?php

namespace App\Http\Controllers;

use App\Models\Regionals;
use App\Models\Societies;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'id_card_number' => 'required|max:200',
            'password' => 'required|max:16',
        ]);

        $societies = Societies::where("id_card_number", $request->input('id_card_number'))->Where('password', $request->input('password'))->first();

        if (!$societies) {
            return response()->json([
                'message' => 'ID Card number or password incorrect'
            ], 401);
        }

        if ($societies) {
            $token = $societies->createToken('login_token')->plainTextToken;
            $societies->update([
                'login_tokens' => $token
            ]);
        }


        return response()->json([
            "name" => $societies->name,
            "born_date" => $societies->born_date,
            "gender" => $societies->gender,
            "address" => $societies->address,
            "token" => $token,
            "regional" => $societies->regional,
        ], 200);
    }


    public function logout($token)
    {
        $societies =  Societies::where('login_tokens', $token)->first();

        if (!$societies) {
            return response()->json([
                'message' => "Invalid Token"
            ], 401);
        }

        $societies->update(['login_tokens' => null]);

        return response()->json([
            'message' => 'Logout success'
        ], 200);
    }
}
