<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\Scores;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class UserController extends Controller
{
    function index()
    {
        $user = User::all();

        return Inertia::render("UserList", [
            'user' => $user
        ]);

        return response()->json([
            'totalElements' => $user->count(),
            'content' => $user,
        ]);
    }

    public function create()
    {
        return Inertia::render("CreateUser", [
            'csrf_token' => csrf_token(),
        ]);
    }

    function store(Request $request)
    {
        // dd('masuk form create');
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username|min:4|max:60',
            'password' => 'required|min:5|max:40'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'Username already exists',
            ], 400);
        }

        User::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('user-list');

        return response()->json([
            'status' => 'success',
            'username' => $request->input('username'),
        ], 200);
    }

    public function edit($id)
    {
        $userWhere = User::where('id', $id)->get();

        return Inertia::render("EditUser", [
            'csrf' => csrf_token(),
            'user' => $userWhere
        ]);
    }

    function update(Request $request, $id)
    {
        // dd('masuk form edit');
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username',
            'password' => 'required|min:5|max:40'
        ]);

        $user = User::findOrFail($id);

        if ($request->username !== $user->username) {
            $rules['username'] = 'required|unique:users,username,' . $id;
        }

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 'invalid',
        //         'message' => 'Username already exists',
        //     ]);
        // }

        $user->update([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('user-list');

        // return response()->json([
        //     'status' => 'success',
        //     'message' => $request->input('username'),
        // ]);
    }

    function destroy($id)
    {
        //cari user bedasarkan id
        $user = User::find($id);

        //jika tidak ada maka akan not found
        if (!$user) {
            return response()->json([
                'status' => 'not found',
                'message' => 'User not found,'
            ], 403);
        }

        $user->delete();

        return redirect()->route('user-list');

        //status 204 tanpa body json
        return response()->noContent();
    }

    public function detailUser($username)
    {
        $user = User::where('username', $username)->first();
        $game = Games::where('created_by', $user->id)->first();
        $highestScore = Scores::where('user_id', $user->id)->first();

        if ($highestScore) {
            $score = $highestScore->score;
            $timeStamp = $highestScore->created_at;
        } else {
            $score = null;
            $timeStamp = null;
        }

        if ($game) {
            $title = $game->title;
            $slug = $game->slug;
            $description = $game->description;
        } else {

            $title = null;
            $slug = null;
            $description = null;
        }

        return response()->json([
            'username' => $user->username,
            'registeredTimestamp' => $user->created_at,
            'authoredGames' => [
                'slug' => $slug,
                'title' => $title,
                'description' => $description,
            ],
            'highScores' => [
                'game' => [
                    'slug' => $slug,
                    'title' => $title,
                    'description' => $description,
                ],
                'score' => $score,
                'timeStamp' => $timeStamp
            ]
        ]);
    }
}
