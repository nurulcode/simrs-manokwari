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
    Route::get('/', 'HomeController@index');
    Route::get('/activities', 'ActivityController@view');
    Route::get('/role', 'RoleController@view');
    Route::get('/user', 'UserController@view');

    Route::middleware('can:manage_fasilitas')->group(function () {
        Route::view('fasilitas', 'fasilitas.index');
    });

    Route::middleware('can:manage_tarif')->group(function () {
        Route::view('tarif', 'tarif.index');
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

    Route::resource('kunjungan', 'KunjunganWebController')->only(['index', 'show']);

    Route::namespace('Perawatan')->prefix('perawatan')->group(function () {
        Route::resource('rawat-jalan', 'RawatJalanWebController')
            ->only(['index', 'create', 'show'])
            ->middleware('can:manage_rawat_jalan');

        Route::resource('rawat-darurat', 'RawatDaruratWebController')
            ->only(['index', 'create', 'show'])
            ->middleware('can:manage_rawat_darurat');

        Route::resource('rawat-inap', 'RawatInapWebController')
            ->only(['index', 'create', 'show'])
            ->middleware('can:manage_rawat_inap');
    });

    Route::namespace('Penunjang')->prefix('penunjang')->group(function () {
        Route::resource('laboratorium', 'LaboratoriumController')
            ->only(['index', 'show'])
            ->middleware('can:manage_laboratorium');
        Route::resource('radiologi', 'RadiologiController')
            ->only(['index', 'show'])
            ->middleware('can:manage_radiologi');
        Route::resource('rehabilitasi-medik', 'RehabilitasiMedikController')
            ->only(['index', 'show'])
            ->middleware('can:manage_rehabilitasi_medik');

        Route::view('operasi',            'penunjang.operasi');
        Route::view('insenerator',        'penunjang.insenerator');
        Route::view('utdrs',              'penunjang.utdrs');
        Route::view('kamar-jenazah',      'penunjang.kamar-jenazah');
    });

    Route::middleware('can:manage_master_data')
        ->prefix('master')
        ->group(function () {
            Route::view('agama',            'master.agama');
            Route::view('cara-pembayaran',  'master.cara-pembayaran');
            Route::view('gizi',             'master.gizi');
            Route::view('jenis-identitas',  'master.jenis-identitas');
            Route::view('jenis-laundry',    'master.jenis-laundry');
            Route::view('jenis-poliklinik', 'master.jenis-poliklinik');
            Route::view('jenis-registrasi', 'master.jenis-registrasi');
            Route::view('jenis-rujukan',    'master.jenis-rujukan');
            Route::view('jenis-visite',     'master.jenis-visite');
            Route::view('kasus',            'master.kasus');
            Route::view('kegiatan',         'master.kegiatan');
            Route::view('oksigen',          'master.oksigen');
            Route::view('pekerjaan',        'master.pekerjaan');
            Route::view('pemeriksaan-umum', 'master.pemeriksaan-umum');
            Route::view('pendidikan',       'master.pendidikan');
            Route::view('penyakit',         'master.penyakit.index');
            Route::view('perawatan-khusus', 'master.perawatan-khusus');
            Route::view('prosedur',         'master.prosedur');
            Route::view('suku',             'master.suku');
            Route::view('tindakan',         'master.tindakan-pemeriksaan');
            Route::view('tipe-diagnosa',    'master.tipe-diagnosa');
            Route::view('wilayah',          'master.wilayah.index');
        });
});
