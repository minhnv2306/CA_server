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


Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'can:manager-user'], function () {
        Route::resource('users', 'UserController');
    });

    Route::put('users/{user}', 'UserController@update');
    Route::get('/profile', 'UserController@profile')->name('users.profile');
    Route::post('/change-password', 'UserController@changePassword')->name('users.change-password');
    Route::get('my-certs', 'CertController@getMyCert')->name('certs.my-cert');
    Route::resource('certs', 'CertController');
    Route::resource('roles', 'RoleController');
    Route::resource('objects', 'ObjectController');
    Route::get('certs/create', 'CertController@create')->name('certs.create')->middleware('can:create-cert');
    Route::post('/users/checkCreate', 'UserController@checkCreate');
    Route::get('users/role', 'UserController@roles')->name('users.roles');
    Route::get('/certs/filter-status/{status}', 'CertController@getListByStatus');
    Route::post('cert/update', 'CertController@update')->name('cert.update');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('/', 'HomeController@dashboard');
    Route::post('certs/filter', 'CertController@filter')->name('filterCert');

    Route::get('ca-information', 'HomeController@getCA')->name('ca');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test/{user}', function (App\Models\User $user){
    dd($user);
});
Route::post('/test', 'HomeController@test');

