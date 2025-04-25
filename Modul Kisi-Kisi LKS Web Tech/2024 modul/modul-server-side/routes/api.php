<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use function Termwind\ask;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::middleware(['auth:sanctum', 'adminCheck', 'checkLogin'])->group(function () {
    // user crud
    Route::post('/v1/auth/signout', [AuthController::class, 'signout']);
    Route::get('v1/admin', [AdminController::class, 'index']);
    Route::post('/v1/users', [UserController::class, 'store']);
    Route::get('/v1/users', [UserController::class, 'detailUser']);
    Route::put('/v1/users/{id}', [UserController::class, 'update']);
    Route::delete('/v1/users/{id}', [UserController::class, 'destroy']);
    Route::get('/v1/users/{username}', [UserController::class, 'detailUser']);

    //games crud
    Route::get('/v1/games', [GamesController::class, 'index']);
    Route::post('/v1/games', [GamesController::class, 'store']);
    Route::get('/v1/games/{slug}', [GamesController::class, 'show']);
    Route::post('/v1/games/{slug}/upload', [GamesController::class, 'upload']);
    Route::get('/games/{slug}/{version}', [GamesController::class, 'demos']);
    Route::put('/v1/games/{slug}', [GamesController::class, 'update']);
    Route::delete('/v1/games/{slug}', [GamesController::class, 'destroy']);
    Route::get('/v1/games/{slug}/score', [GamesController::class, 'score']);
    Route::post('/v1/games/{slug}/scores', [GamesController::class, 'scorePost']);
});
Route::post('/v1/auth/signup', [SignupController::class, 'signup']);
Route::post('/v1/auth/signin', [SigninController::class, 'signin']);
