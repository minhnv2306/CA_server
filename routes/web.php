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

    Route::resource('certs', 'CertController');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::get('users/role', 'UserController@roles')->name('users.roles');
    Route::get('certs/filter-status/{status}', 'CertController@getListByStatus');
    Route::post('cert/update', 'CertController@update')->name('cert.update');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function (){
    return view('test');
});

