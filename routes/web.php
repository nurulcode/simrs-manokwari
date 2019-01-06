<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes([
    'register' => false,
    'reset'    => false,
    'verify'   => false,
]);

Route::middleware(['auth'])->group(function () {
    Route::middleware('can:manage_fasilitas')->group(function () {
        Route::view('fasilitas', 'fasilitas.index');
    });

    Route::middleware('can:manage_pasien')->group(function () {
        Route::view('pasien', 'pasien');
    });

    Route::middleware('can:manage_permission')->group(function () {
        Route::view('permission', 'permission');
    });

    Route::middleware('can:manage_kepegawaian')->group(function () {
        Route::view('kepegawaian', 'kepegawaian.index');
    });

    Route::get('/', 'HomeController@index');
    Route::get('/activities', 'ActivityController@view');
    Route::get('/role', 'RoleController@view');
    Route::get('/user', 'UserController@view');

    Route::get('/kunjungan', 'KunjunganWebController@index');
    Route::get('/kunjungan/{kunjungan}', 'KunjunganWebController@show');

    Route::namespace('Perawatan')->prefix('perawatan')->group(function () {
        Route::middleware('can:manage_rawat_jalan')->group(function () {
            Route::get('/rawat-jalan', 'RawatJalanWebController@index');
            Route::get('/rawat-jalan/create', 'RawatJalanWebController@create');
            Route::get('/rawat-jalan/{rawat_jalan}', 'RawatJalanWebController@show');
        });

        Route::middleware('can:manage_rawat_darurat')->group(function () {
            Route::get('/rawat-darurat', 'RawatDaruratWebController@index');
            Route::get('/rawat-darurat/create', 'RawatDaruratWebController@create');
            Route::get('/rawat-darurat/{rawat_darurat}', 'RawatDaruratWebController@show');
        });
    });

    Route::namespace('Master')
        ->middleware('can:manage_master_data')
        ->prefix('master')
        ->group(function () {
            Route::view('penyakit',         'master.penyakit.index');
            Route::view('wilayah',          'master.wilayah.index');
            Route::view('agama',            'master.agama');
            Route::view('cara-pembayaran',  'master.cara-pembayaran');
            Route::view('jenis-identitas',  'master.jenis-identitas');
            Route::view('jenis-poliklinik', 'master.jenis-poliklinik');
            Route::view('jenis-registrasi', 'master.jenis-registrasi');
            Route::view('jenis-rujukan',    'master.jenis-rujukan');
            Route::view('kasus',            'master.kasus');
            Route::view('kegiatan',         'master.kegiatan');
            Route::view('pekerjaan',        'master.pekerjaan');
            Route::view('pendidikan',       'master.pendidikan');
            Route::view('suku',             'master.suku');
            Route::view('tindakan',         'master.tindakan-pemeriksaan');
            Route::view('tipe-diagnosa',    'master.tipe-diagnosa');
        });
});
