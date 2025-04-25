<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\GameVersions;
use App\Models\Scores;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Laravel\Sanctum\PersonalAccessToken;

class GamesController extends Controller
{
    function index(Request $request)
    {
        $page = (int) $request->query('page', 0);
        $size = max((int) $request->query('size', 10), 1);
        $sortBy = $request->query('sortBy', 'title');
        $sortDir = $request->query('sortDir', 'asc');

        $allowedSortBy = ['title', 'created_at', 'updated_at'];
        if (!in_array($sortBy, $allowedSortBy)) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Invalid sortBy value. Must be one of: title, created_at, updated_at',
            ], 400);
        }
        $totalElements = Games::count();

        $games = Games::with('scores')->orderBy($sortBy, $sortDir)->offset($page * $size)->limit($size)->get();

        $content = $games->map(function ($game) {
            $author = User::where('id', $game->created_by)->first();
            // $totalScore = DB::table('scores')->where('user_id', $game->created_by)->sum('score');
            return [
                'slug' => $game->slug,
                'title' => $game->title,
                'description' => $game->description,
                'thumbnail' => "/games/{$game->slug}/thumbnail.png",
                'uploadTimestamp' => $game->uploadTimestamp,
                'author' => $author->username,
                'scoreCount' => $game->getScore(),
            ];
        });

        return Inertia::render("DiscoverGame", [
            'game' => $content,
        ]);

        return response()->json([
            'page' => $page,
            'size' => $size,
            'totalElements' => $totalElements,
            'content' => $content
        ]);
    }

    public function create()
    {
        return Inertia::render("CreateGame");
    }

    public function upload(Request $request, $slug)
    {
        $game = Games::where('slug', $slug)->first();

        if (!$game) {
            return response()->json(['message' => 'Game Not Found'], 404);
        }

        $token = PersonalAccessToken::findToken($request->bearerToken());

        if (!$token) {
            return response()->json(['message' => 'Invalid Token'], 401);
        }

        $userId = $token->tokenable_id;

        if ($game->created_by != $userId) {
            return response()->json(['message' => 'User is not author the game'], 403);
        }

        if (!$request->hasFile('zipfile')) {
            return response()->json(['message' => 'No zip file uploded'], 400);
        }

        $lastVersion = GameVersions::where('game_id', $game->id)->max('version') ?? 0;
        $newVersion =  "v" . ((float) $lastVersion + 1);

        $file = $request->file('zipfile');
        $filePath = "games/{$game->id}/version_{$newVersion}.zip";
        $file->storeAs("public/" . $filePath);

        GameVersions::create([
            'game_id' => $game->id,
            'version' => $newVersion,
            'storage_path' => $filePath,
        ]);

        return response()->json([
            'message' => 'Game version $newVersion uploaded successfully'
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:60',
            'description' => 'required|min:0|max:200',
        ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 'Error',
        //         'message' => $validator->errors(),
        //     ], 400);
        // }

        $slug = Str::slug($request->input('title'));

        // if (Games::where('slug', $slug)->exists()) {
        //     return response()->json([
        //         'status' => 'invalid',
        //         'slug' => 'Game title already exists'
        //     ], 400);
        // }

        $game = Games::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'slug' => $slug,
            'created_by' => Auth::user()->id,
        ]);

        $game = Games::where('slug', $slug)->first();

        // if (!$game) {
        //     return response()->json(['message' => 'Game Not Found'], 404);
        // }

        // if (!$request->hasFile('zipfile')) {
        //     return response()->json(['message' => 'No zip file uploded'], 400);
        // }

        $lastVersion = GameVersions::where('game_id', $game->id)->max('version') ?? 0;
        $newVersion =  "v" . ((float) $lastVersion + 1);

        $file = $request->file('zipfile');
        $filePath = "games/{$game->id}/version_{$newVersion}.zip";
        $file->storeAs("public/" . $filePath);

        GameVersions::create([
            'game_id' => $game->id,
            'version' => $newVersion,
            'storage_path' => $filePath,
        ]);

        return redirect()->route('manage-game');

        // return response()->json([
        //     'status' => 'success',
        //     'slug' => $game->slug,
        // ], 201);
    }

    public function show($slug)
    {
        $game = Games::where('slug', $slug)->first();
        // dd($game);

        if (!$game) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Game not found',
            ], 404);
        }

        $gameVersion = $game->gameVersions->last();
        $version = GameVersions::where('game_id', $game->id)->first();

        if (!$gameVersion) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Game Version Not found',
            ], 404);
        }

        $score = Scores::where('game_version_id', $game->id)->sum('score');
        $thumnail = "games/{$game->slug}/{$gameVersion->version}/thumbnail.jpg";
        $gamePath = "game/{$game->slug}/{$gameVersion->version}";
        $topScores = Scores::where('game_version_id', $game->id)->orderBy('score', 'desc')->limit(10)->with('user')->get();

        return Inertia::render("DetailGame", [
            'slug' => $game->slug,
            'title' => $game->title,
            'description' => $game->description,
            'thumbnail' => $thumnail,
            'uploadTimestamp' => $game->created_at,
            'author' => $game->user->username,
            'authorId' => $game->user->id,
            'score' => $topScores,
            'gamePath' => $gamePath,
            'version' => $version->version,
        ]);

        return response()->json([
            'slug' => $game->slug,
            'title' => $game->title,
            'description' => $game->description,
            'thumbnail' => $thumnail,
            'uploadTimestamp' => $game->created_at,
            'author' => $game->user->username,
            'scoreCount' => $score,
            'gamePath' => $gamePath
        ]);
    }

    public function demos($slug, $version)
    {
        $filePath = "games/{$slug}/{$version}.zip";
        $fullPath = public_path($filePath);

        if (!file_exists($filePath)) {
            return response()->json([
                'status' => 'Error',
                'message' => 'File not Found',
                'file' => $fullPath,
            ], 404);
        }

        return response()->download($fullPath);
    }

    public function edit($id)
    {
        $game = Games::where('id', $id)->get();

        return Inertia::render("EditGame", [
            'game' => $game
        ]);
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required|max:60',
            'description' => 'required|max:200'
        ]);

        $game = Games::where('slug', $slug)->first();

        // if (Auth::user()->id != $game->created_by) {
        //     return response()->json([
        //         'status' => 'Forbidden',
        //         'message' => 'you are not the game author'
        //     ]);
        // }

        $game->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        // Ambil versi terakhir dari game ini
        $latestVersion = GameVersions::where('game_id', $game->id)
            ->orderBy('created_at', 'desc')
            ->first();

        // Jika ada file ZIP baru, update versi game
        if ($request->hasFile('zipfile')) {
            $file = $request->file('zipfile');

            // Jika sudah ada versi sebelumnya, update versi terakhir
            if ($latestVersion) {
                $filePath = "games/{$game->id}/version_{$latestVersion->version}.zip";
                $file->storeAs("public/" . $filePath); // Simpan file di storage

                // Update data versi terakhir
                $latestVersion->update([
                    'storage_path' => $filePath,
                    'updated_at' => now(),
                ]);
            } else {
                // Jika belum ada versi sebelumnya, buat versi pertama
                $newVersion = "v1.0";
                $filePath = "games/{$game->id}/version_{$newVersion}.zip";
                $file->storeAs("public/" . $filePath);

                GameVersions::create([
                    'game_id' => $game->id,
                    'version' => $newVersion,
                    'storage_path' => $filePath,
                ]);
            }
        }

        return redirect()->route('manage-game');

        // return response()->json([
        //     'status' => 'success'
        // ]);
    }

    public function destroy($slug)
    {
        $game = Games::where('slug', $slug)->first();

        // if (Auth::user()->id != $game->created_by) {
        //     return response()->json([
        //         'status' => 'Forbidden',
        //         'message' => 'You are not author game'
        //     ]);
        // }

        foreach ($game->gameVersions as $version) {
            $version->delete();
        }

        foreach ($game->scores as $score) {
            $score->delete();
        }
        $game->delete();

        return redirect()->route('manage-game');
        // return response()->noContent();
    }

    public function score($slug)
    {
        $game = Games::where('slug', $slug)->first();
        $user = User::where('id', $game->created_by)->first();
        $score = Scores::where('user_id', $user->id)->first();

        if ($score) {
            $scores = $score->score;
        } else {
            $scores = null;
        }

        return response()->json([
            'username' => $user->username,
            'score' => $scores,
            'timestamp' => $game->created_at
        ], 200);
    }

    public function scorePost(Request $request, $slug)
    {
        $game = Games::where('slug', $slug)->first();
        $user = User::where('id', $game->created_by)->first();
        $score = Scores::where('user_id', $user->id)->first();
        $gameVersion = GameVersions::where('game_id', $game->id)->first();

        $score->create([
            'user_id' => $user->id,
            'game_version_id' => $gameVersion->id,
            'score' => $request->input('score'),
        ]);

        return response()->json([
            'status' => 'success',
            'score' => $request->input('score'),
        ]);
    }

    public function profileGame($authorId)
    {
        $user = User::where('id', $authorId)->first();
        $games = Games::where('created_by', $authorId)->with('scores')->get();
        $game = Games::where('created_by', $authorId)->first();

        $highscores = Scores::where('user_id', $authorId)
            ->join('game_versions', 'scores.game_version_id', '=', 'game_versions.id')
            ->join('games', 'game_versions.game_id', '=', 'games.id')
            ->select('games.title', 'scores.score')
            ->orderByDesc('scores.score')
            ->get();
        $versi = GameVersions::where('game_id', $game->id)->first();
        $gameScore = Scores::where('game_version_id', $versi->id)->first();


        return Inertia::render('ProfileGame', [
            'user' => $user,
            'game' => $games,
            'gameScore' => $gameScore->score,
            'highScore' => $highscores
        ]);
    }

    public function manageGame()
    {
        $game = Games::all();

        return Inertia::render("ManageGame", [
            'game' => $game,
        ]);
    }
}
