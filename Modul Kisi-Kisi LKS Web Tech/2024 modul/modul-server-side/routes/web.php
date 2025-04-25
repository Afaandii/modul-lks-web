<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/admin-list', [AdminController::class, 'index'])->name('admin-list');
    Route::get('/user-list', [UserController::class, 'index'])->name('user-list');
    Route::get('/create-form-user', [UserController::class, 'create'])->name('user-form');
    Route::post('/create-user', [UserController::class, 'store'])->name('create-user');
    Route::get('/update-user-form/{id}', [UserController::class, 'edit'])->name('edit-user');
    Route::put('/user-edit/{id}', [UserController::class, 'update'])->name('update-user');
    Route::delete('/user-delete/{id}', [UserController::class, 'destroy'])->name('user-delete');

    Route::get('/discover-game', [GamesController::class, 'index'])->name('discover-game');
    Route::get('/detail-game/{slug}', [GamesController::class, 'show'])->name('detail-game');
    Route::get('/profile-game/{author}', [GamesController::class, 'profileGame'])->name('profile-game');
    Route::get('/manage-game', [GamesController::class, 'manageGame'])->name('manage-game');
    Route::get('/create-game', [GamesController::class, 'create'])->name('game-form-create');
    Route::post('/store-game', [GamesController::class, 'store'])->name('store-game');
    Route::get('/edit-game/{id}', [GamesController::class, 'edit'])->name('edit-game');
    Route::put('/update-game/{slug}', [GamesController::class, 'update'])->name('update-game');
    Route::delete('/delete-game/{slug}', [GamesController::class, 'destroy'])->name('delete-game');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
