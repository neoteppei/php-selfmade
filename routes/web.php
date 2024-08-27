<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\DivingSpotController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return redirect()->route('logs.index');
});

// 認証関連のルート
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// 認証されたユーザーのみアクセスできるルート
Route::middleware('auth')->group(function () {
    // トップページやログ一覧ページへのリダイレクト設定
    Route::get('/', [LogController::class, 'logs.index'])->name('home');

    Route::get('/logform', function () {
        return view('logform');
    })->name('logs.create');

    Route::middleware(['auth'])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.users');
        Route::delete('/', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    });

    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
    Route::get('/logs/{id}', [LogController::class, 'show'])->name('logs.show');
    Route::get('/logs/{id}/edit', [LogController::class, 'edit'])->name('logs.edit');
    Route::put('/logs/{id}', [LogController::class, 'update'])->name('logs.update');
    Route::delete('/logs/{id}', [LogController::class, 'destroy'])->name('logs.destroy');
    Route::post('/logs', [LogController::class, 'store'])->name('logs.store');

    Route::get('licenses/create', [LicenseController::class, 'create'])->name('licenses.create');
    Route::post('licenses', [LicenseController::class, 'store'])->name('licenses.store');
    Route::delete('license-images/{id}', [LicenseController::class, 'destroyImage'])->name('licenses.destroyImage');

    Route::get('/diving_spots/create', [DivingSpotController::class, 'create'])->name('diving_spots.create');
    Route::post('/diving_spots/search', [DivingSpotController::class, 'search'])->name('diving_spots.search');
});