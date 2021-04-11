<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RoomController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware('auth:sanctum')->group(function() {

    Route::get('/users/{login}', [UserController::class, 'show'])->middleware('checkLogin');
    Route::put('/users', [UserController::class, 'store']);
    Route::delete('/users/{login}', [UserController::class, 'destroy']);

    Route::get('/subscribers', [AccountController::class, 'subscribers']);
    Route::get('/subscribe', [AccountController::class, 'subscribe']);
    Route::put('/image/upload', [AccountController::class, 'edit']);
    Route::get('/image', [AccountController::class, 'showImage']);
    Route::get('/user_info', [AccountController::class, 'userInfo']);

    Route::get('/chatItems', [ChatController::class, 'index']);
    Route::put('/chats', [ChatController::class, 'store']);
    Route::put('/chat/edit', [ChatController::class, 'edit']);
    Route::delete('/exit/{id}', [ChatController::class, 'exit']);
    Route::delete('/chats/{chat}', [ChatController::class, 'destroy']);

    Route::put('/message', [RoomController::class, 'store']);

});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/chats', function () {
        return Inertia::render('Chats');
    })->name('chats');

    Route::get('/room', function () {
        return redirect('/chats');
    });

    Route::post('/room', [RoomController::class, 'index'])->name('room');

    Route::get('/find', function () {
        return Inertia::render('Find');
    })->name('find');

    Route::get('/account', function () {
        return Inertia::render('Account');
    })->name('account');
});
