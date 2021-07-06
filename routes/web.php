<?php

use App\Http\Controllers\BiodataController;
use App\Http\Controllers\Indonesia\{DesaController, KecamatanController, KotaController, ProvinsiController};
use App\Http\Controllers\Kampus\{FakultasController, ProdiController};
use App\Http\Controllers\Perusahaan\{DataController as DataPerusahaanController, KategoriController};
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::group([
    'middleware' => 'auth'
], function() {
    Route::get('/', function () {
        return view('app.dashboard');
    })->name('home');

    Route::get('biodata/datatable', [BiodataController::class, 'dataTable'])->name('biodata.datatable');
    Route::post('biodata/update', [BiodataController::class, 'update'])->name('biodata.update');
    Route::post('biodata/delete', [BiodataController::class, 'destroy'])->name('biodata.destroy');
    Route::resource('biodata', BiodataController::class)->except([ 'show', 'edit', 'update', 'destroy' ]);
    Route::get('biodata/{biodata}/edit', [BiodataController::class, 'edit'])->name('biodata.edit');


    Route::name('perusahaan.')
        ->prefix('perusahaan')
        ->group(function() {

            Route::get('data/datatable', [DataPerusahaanController::class, 'dataTable'])->name('data.datatable');
            Route::post('data/update', [DataPerusahaanController::class, 'update'])->name('data.update');
            Route::post('data/delete', [DataPerusahaanController::class, 'destroy'])->name('data.destroy');
            Route::resource('data', DataPerusahaanController::class)->except([ 'show', 'update', 'destroy' ]);

            Route::get('kategori', [ KategoriController::class, 'index' ])->name('kategori.index');
            Route::get('kategori/datatable', [KategoriController::class, 'dataTable'])->name('kategori.datatable');
            Route::post('kategori/store', [ KategoriController::class, 'store' ])->name('kategori.store');
            Route::post('kategori/update', [ KategoriController::class, 'update' ])->name('kategori.update');
            Route::post('kategori/delete', [ KategoriController::class, 'destroy' ])->name('kategori.destroy');
            Route::get('kategori/select', [ KategoriController::class, 'selectTwo' ])->name('kategori.select');

        });


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


    Route::name('indonesia.')
        ->prefix('indonesia')
        ->group(function() {

            Route::get('provinsi/select', [ ProvinsiController::class, 'selectTwo' ])->name('provinsi.select');
            Route::get('kota/select', [ KotaController::class, 'selectTwo' ])->name('kota.select');
            Route::get('kecamatan/select', [ KecamatanController::class, 'selectTwo' ])->name('kecamatan.select');
            Route::get('desa/select', [ DesaController::class, 'selectTwo' ])->name('desa.select');

        });
});


Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
