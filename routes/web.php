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
    Route::get('/permission',   'PermissionController@view');
    Route::get('/role',         'RoleController@view');
    Route::get('/user',         'UserController@view');

    Route::namespace('Master')->prefix('master')->group(function () {
        Route::get('wilayah',  'Wilayah\\WilayahController@view');
        Route::get('kegiatan', 'KategoriKegiatanController@view');
        Route::get('penyakit', 'Penyakit\\PenyakitController@view');
        Route::get('tindakan', 'TindakanPemeriksaanController@view');
    });
});
