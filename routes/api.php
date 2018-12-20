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
        'activity'    => 'ActivityController',
        'kunjungan'   => 'KunjunganController',
        'pasien'      => 'PasienController',
        'permission'  => 'PermissionController',
        'rawat-jalan' => 'RawatJalanController',
        'role'        => 'RoleController',
        'user'        => 'UserController',
    ]);

    Route::prefix('master')->group(base_path('routes/master.php'));

    Route::prefix('fasilitas')->group(base_path('routes/fasilitas.php'));

    Route::prefix('kepegawaian')->group(base_path('routes/kepegawaian.php'));
});

//TODO: Hapus saat production
Route::get('client', function () {
    return response()->json(
        DB::table('oauth_clients')->select('*')->where('password_client', 1)->first()
    );
});
