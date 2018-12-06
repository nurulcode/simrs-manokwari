<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:api'])->group(function () {
    Route::put('user/password',      'UserPasswordUpdateController')->name('user.password');
    Route::put('user/{user}/toggle', 'UserActivationToggleController')->name('user.toggle');

    Route::apiResources([
        'user'       => 'UserController',
        'role'       => 'RoleController',
        'permission' => 'PermissionController',
        'activity'   => 'ActivityController'
    ]);

    Route::namespace('Master')->prefix('master')->name('master.')->group(function () {
        Route::apiResources([
            'kategori-kegiatan' => 'KategoriKegiatanController',
            'kegiatan'          => 'KegiatanController'
        ]);

        Route::namespace('Wilayah')->prefix('wilayah')->name('wilayah.')->group(function () {
            Route::get('provinsi/{provinsi}/kota-kabupaten', 'ProvinsiKotaKabupatenController');

            Route::post('provinsi/{provinsi}/kota-kabupaten', 'KotaKabupatenController@store');

            Route::get('kota-kabupaten/{kota_kabupaten}/kecamatan', 'KotaKabupatenKecamatanController');

            Route::post('kota-kabupaten/{kota_kabupaten}/kecamatan', 'KecamatanController@store');

            Route::get('kecamatan/{kecamatan}/kelurahan', 'KecamatanKelurahanController');

            Route::post('kecamatan/{kecamatan}/kelurahan', 'KelurahanController@store');

            Route::apiResources([
                'provinsi'       => 'ProvinsiController',
                'kota-kabupaten' => 'KotaKabupatenController',
                'kecamatan'      => 'KecamatanController',
                'kelurahan'      => 'KelurahanController',
            ]);
        });
    });
});

//TODO: Hapus saat production
Route::get('client', function () {
    return response()->json(
        DB::table('oauth_clients')
            ->select('*')
            ->where('password_client', 1)
            ->first()
    );
});
