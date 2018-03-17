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
Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'can:manager-user'], function () {
        Route::resource('users', 'UserController');
    });
    Route::put('users/{user}', 'UserController@update');
    Route::get('/profile', 'UserController@profile')->name('users.profile');
    Route::post('/change-password', 'UserController@changePassword')->name('users.change-password');
    Route::resource('certs', 'CertController');
    Route::resource('roles', 'RoleController');
    Route::resource('objects', 'ObjectController');
    Route::get('certs/create', 'CertController@create')->name('certs.create')->middleware('can:create-cert');
    Route::post('/users/checkCreate', 'UserController@checkCreate');
    Route::get('users/role', 'UserController@roles')->name('users.roles');
    Route::get('certs/filter-status/{status}', 'CertController@getListByStatus');
    Route::post('cert/update', 'CertController@update')->name('cert.update');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::post('certs/filter', 'CertController@filter')->name('filterCert');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function (){
    return view('test');
});

