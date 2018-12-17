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
    Route::get('/',             'HomeController@index');
    Route::get('/activities',   'ActivityController@view');
    Route::get('/fasilitas',    'Fasilitas\\FasilitasController@view');
    Route::get('/kepegawaian',  'Kepegawaian\\KepegawaianController@view');
    Route::get('/pasien',       'PasienController@view');
    Route::get('/permission',   'PermissionController@view');
    Route::get('/role',         'RoleController@view');
    Route::get('/user',         'UserController@view');

    Route::namespace('Master')->prefix('master')->group(function () {
        Route::get('agama',             'AgamaController@view');
        Route::get('jenis-identitas',   'JenisIdentitasController@view');
        Route::get('jenis-poliklinik',  'JenisPoliklinikController@view');
        Route::get('jenis-registrasi',  'JenisRegistrasiController@view');
        Route::get('kasus',             'KasusController@view');
        Route::get('kegiatan',          'KategoriKegiatanController@view');
        Route::get('pekerjaan',         'PekerjaanController@view');
        Route::get('pendidikan',        'PendidikanController@view');
        Route::get('penyakit',          'Penyakit\\PenyakitController@view');
        Route::get('suku',              'SukuController@view');
        Route::get('tindakan',          'TindakanPemeriksaanController@view');
        Route::get('wilayah',           'Wilayah\\WilayahController@view');
    });

    Route::prefix('kunjungan')->group(base_path('routes/kunjungan.php'));
});
