<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\API\UserController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware('auth:sanctum')->group(function() {

    Route::get('/users/{login}', [UserController::class, 'show']);
    Route::put('/users', [UserController::class, 'store']);
    Route::delete('/users/{login}', [UserController::class, 'destroy']);

    Route::get('/chatItems', [\App\Http\Controllers\ChatController::class, 'index']);

});



Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/chats', function () {
        return Inertia::render('Chats');
    })->name('chats');

    Route::get('/room/{id}', function () {
        return Inertia::render('Room');
    })->name('room');

    Route::get('/find', function () {
        return Inertia::render('Find');
    })->name('find');

    Route::get('/profile', function () {
        return Inertia::render('Profile');
    })->name('profile');

});
