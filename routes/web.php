<?php

use App\Http\Controllers\Kampus\FakultasController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;


Route::group([
    'middleware' => 'auth'
], function() {
    Route::get('/', function () {
        return view('app.dashboard');
    })->name('home');


    Route::name('kampus.')
        ->prefix('kampus')
        ->group(function() {
            Route::get('fakultas/datatable', [FakultasController::class, 'dataTable'])->name('fakultas.datatable');
            Route::resource('fakultas', FakultasController::class);
        });
});


Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
