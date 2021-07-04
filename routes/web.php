<?php

use App\Http\Controllers\Kampus\{FakultasController, ProdiController};
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

            Route::get('fakultas', [ FakultasController::class, 'index' ])->name('fakultas.index');
            Route::get('fakultas/datatable', [FakultasController::class, 'dataTable'])->name('fakultas.datatable');
            Route::post('fakultas/store', [ FakultasController::class, 'store' ])->name('fakultas.store');
            Route::post('fakultas/update', [ FakultasController::class, 'update' ])->name('fakultas.update');
            Route::post('fakultas/delete', [ FakultasController::class, 'destroy' ])->name('fakultas.destroy');
            Route::get('fakultas/select', [ FakultasController::class, 'selectTwo' ])->name('fakultas.select');

            Route::get('prodi', [ ProdiController::class, 'index' ])->name('prodi.index');
            Route::get('prodi/datatable', [ProdiController::class, 'dataTable'])->name('prodi.datatable');
            Route::post('prodi/store', [ ProdiController::class, 'store' ])->name('prodi.store');
            Route::post('prodi/update', [ ProdiController::class, 'update' ])->name('prodi.update');
            Route::post('prodi/delete', [ ProdiController::class, 'destroy' ])->name('prodi.destroy');
            Route::get('prodi/detail', [ ProdiController::class, 'show' ])->name('prodi.show');

        });
});


Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
