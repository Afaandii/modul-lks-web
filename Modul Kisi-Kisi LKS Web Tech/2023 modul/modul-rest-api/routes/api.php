<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SociestiesController;
use App\Http\Controllers\SocietiesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum', 'tokenCheck'])->group(function () {
    Route::post('/v1/auth/logout/{token}', [AuthController::class, 'logout']);
    Route::post('/v1/auth/validation/{token}', [SociestiesController::class, 'validation']);
    Route::get('v1/auth/validation/{token}', [SociestiesController::class, 'getSociety']);
    Route::get('v1/auth/job_vacancy/{token}', [SociestiesController::class, 'jobVacancy']);
    Route::get('/v1/job_vacancy/{id}', [SociestiesController::class, 'detailVacancy']);

    // applying jobs
    Route::post('/v1/application', [SociestiesController::class, 'store']);
    Route::get('/v1/applications', [SociestiesController::class, 'getSocietyJob']);
});

Route::post('/v1/auth/login', [AuthController::class, 'login']);
