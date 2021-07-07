<?php

use App\Http\Controllers\BiodataController;
use App\Http\Controllers\Iku\KerjaLayakController;
use App\Http\Controllers\Indonesia\{DesaController, KecamatanController, KotaController, ProvinsiController};
use App\Http\Controllers\Kampus\{FakultasController, ProdiController};
use App\Http\Controllers\Mahasiswa\AlumniController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Perusahaan\{DataController as DataPerusahaanController, KategoriController};
use App\Http\Controllers\User\ResetPasswordAdminController;
use App\Http\Controllers\User\UserRoleController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::group([
    'middleware' => 'auth'
], function() {
    Route::get('/', function () {
        return view('app.dashboard');
    })->name('home');

    Route::name('iku.')
        ->prefix('iku')
        ->group(function() {

            Route::get('kerja-layak/datatable', [KerjaLayakController::class, 'dataTable'])->name('kerja-layak.datatable');
            Route::get('kerja-layak/export-excel', [KerjaLayakController::class, 'exportExcel'])->name('kerja-layak.export-excel');
            Route::post('kerja-layak/update', [KerjaLayakController::class, 'update'])->name('kerja-layak.update');
            Route::post('kerja-layak/delete', [KerjaLayakController::class, 'destroy'])->name('kerja-layak.destroy');
            Route::get('kerja-layak/{kerja_layak}/edit', [KerjaLayakController::class, 'edit'])->name('kerja-layak.edit');
            Route::resource('kerja-layak', KerjaLayakController::class)->except([ 'show', 'edit', 'update', 'destroy' ]);

        });


    Route::get('alumni/select', [AlumniController::class, 'selectTwo'])->name('alumni.select');
    Route::get('alumni/show', [AlumniController::class, 'show'])->name('alumni.show');


    Route::get('mahasiswa/datatable', [MahasiswaController::class, 'dataTable'])->name('mahasiswa.datatable');
    Route::post('mahasiswa/update', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::post('mahasiswa/delete', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
    Route::resource('mahasiswa', MahasiswaController::class)->except([ 'show', 'edit', 'update', 'destroy' ]);
    Route::get('mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');


    Route::get('biodata/datatable', [BiodataController::class, 'dataTable'])->name('biodata.datatable');
    Route::get('biodata/show', [BiodataController::class, 'show'])->name('biodata.show');
    Route::post('biodata/update', [BiodataController::class, 'update'])->name('biodata.update');
    Route::post('biodata/delete', [BiodataController::class, 'destroy'])->name('biodata.destroy');
    Route::get('biodata/select', [BiodataController::class, 'selectTwo'])->name('biodata.select');
    Route::resource('biodata', BiodataController::class)->except([ 'show', 'edit', 'update', 'destroy' ]);
    Route::get('biodata/{biodata}/edit', [BiodataController::class, 'edit'])->name('biodata.edit');


    Route::name('perusahaan.')
        ->prefix('perusahaan')
        ->group(function() {

            Route::get('data/datatable', [DataPerusahaanController::class, 'dataTable'])->name('data.datatable');
            Route::get('data/select', [DataPerusahaanController::class, 'selectTwo'])->name('data.select');
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


    Route::get('user-role/datatable', [ UserRoleController::class, 'dataTable' ])->name('user-role.datatable');
    Route::post('user-role/update', [ UserRoleController::class, 'update' ])->name('user-role.update');
    Route::post('user-role/delete', [ UserRoleController::class, 'destroy' ])->name('user-role.destroy');
    Route::resource('user-role', UserRoleController::class)->except([ 'show', 'edit', 'update', 'destroy' ]);

    Route::post('admin/reset-password', [ ResetPasswordAdminController::class, 'store' ])->name('admin.reset-password');


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
