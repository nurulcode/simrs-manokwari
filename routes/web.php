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
    Route::get('/user',         'UserController@view');
    Route::get('/role',         'RoleController@view');
    Route::get('/permission',   'PermissionController@view');
    Route::get('/activities',   'ActivityController@view');
});
