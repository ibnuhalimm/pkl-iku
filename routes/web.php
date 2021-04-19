<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::group([
    'middleware' => 'auth'
], function() {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
});


Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
