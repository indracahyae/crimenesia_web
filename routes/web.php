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

//ROUTE APLIKASI ADMINISTRATOR
//login
	Route::get('vLoginAdmin', 'Admin\LoginAdminC@login');
	Route::post('setLoginAdmin', 'Admin\LoginAdminC@setLogin');
	Route::get('logOutAdmin', 'Admin\LoginAdminC@setLogout');
//ROUTE ADMIN WITH MIDDLEWARE
Route::group(['middleware' => 'checkLogin'], function () {
    //home
	Route::get('homeAdmin', 'Admin\CrudAdmin@homeAdmin');
	//my Profile
	Route::get('myProfileAdmin', 'Admin\CrudAdmin@myProfile');
	Route::get('showMyAccount', 'Admin\CrudAdmin@showMyProfile');
	Route::post('updateMyAccount', 'Admin\CrudAdmin@updateMyProfile');
	//crud admin
	Route::get('homeCrudAdmin', 'Admin\CrudAdmin@homeCrudAdmin');
    Route::resource('crudAdmins', 'Admin\CrudAdmin');
    //society

	//police
});

//ROUTE APLIKASI POLICE


//ROUTE APLIKASI ANGGOTA POLISI


//ROUTE APLIKASI SOCIETY