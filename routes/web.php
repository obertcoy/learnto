<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkshopController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users/{user}', 'show')->name('users.show');
        Route::patch('/users/{user}', 'update')->name('users.update');
        Route::post('/workshops/{workshop}/join', 'joinWorkshop')->name('users.joinWorkshop');
    });

    Route::controller(WorkshopController::class)->group(function () {
        Route::get('/workshops/create', 'create')->name('workshops.create');
        Route::post('/workshops/store', 'store')->name('workshops.store');
        Route::patch('/workshops/{workshop}', 'update')->name('workshops.update');
        Route::get('/workshops/{workshop}/payment', 'payment')->name('workshops.payment');
    });
});

Route::controller(WorkshopController::class)->group(function () {
    Route::get('/', 'featured')->name('workshops.welcome');
    Route::get('/explore', 'index')->name('workshops.explore');
    Route::get('/workshops/{workshop}', 'show')->name('workshops.show');
});

Route::get("ping", function () {
    return 'pong';
});

require __DIR__ . '/auth.php';
