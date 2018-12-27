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
    Route::get('/fasilitas', 'Fasilitas\\FasilitasViewController');
    Route::get('/kepegawaian', 'Kepegawaian\\KepegawaianController@view');
    Route::get('/pasien', 'PasienController@view');
    Route::get('/permission', 'PermissionController@view');
    Route::get('/permission', 'PermissionController@view');
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

    Route::namespace('Master')->prefix('master')->group(function () {
        Route::get('penyakit', 'Penyakit\\PenyakitViewController');
        Route::get('wilayah', 'Wilayah\\WilayahViewController');
        Route::get('agama', 'AgamaViewController');
        Route::get('cara-pembayaran', 'CaraPembayaranViewController');
        Route::get('jenis-identitas', 'JenisIdentitasViewController');
        Route::get('jenis-poliklinik', 'JenisPoliklinikViewController');
        Route::get('jenis-registrasi', 'JenisRegistrasiViewController');
        Route::get('jenis-rujukan', 'JenisRujukanViewController');
        Route::get('kasus', 'KasusViewController');
        Route::get('kegiatan', 'KegiatanViewController');
        Route::get('pekerjaan', 'PekerjaanViewController');
        Route::get('pendidikan', 'PendidikanViewController');
        Route::get('suku', 'SukuViewController');
        Route::get('tindakan', 'TindakanPemeriksaanViewController');
        Route::get('tipe-diagnosa', 'TipeDiagnosaViewController');
    });
});
