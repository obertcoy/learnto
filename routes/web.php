<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkshopController;
use Illuminate\Support\Facades\Route;

Route::controller(WorkshopController::class)->group(function () {
    Route::get('/', 'featured')->name('workshops.welcome');
    Route::get('/explore', 'index')->name('workshops.explore');
    Route::get('/workshops/{workshop}', 'show')->name('workshops.show');

});


Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile','update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users/{user}', 'show')->name('users.show');
    });

    Route::controller(WorkshopController::class)->group(function() {
        Route::get('/workshop/{workshop}/payment', 'payment')->name('workshops.payment');
    });
    
});

Route::get("ping" , function() {
    return 'pong';
});

require __DIR__.'/auth.php';
