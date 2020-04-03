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

Route::get('auth/verify/{confirmationCode}', 'AuthController@getVerify');
Auth::routes();
// Auth::routes(['register' => false]);

Route::group(['namespace' => 'FrontEnd'], function () {
    Route::get('/', 'HomeController@index')->name('home');
});

Route::group(['middleware' => ['auth']], function () {
	Route::get('dashboard', 'HomeController@getDashboard');
	Route::get('profile', 'HomeController@getProfile');
    Route::get('change-password', 'HomeController@getChangePassword');
    Route::post('change-password', 'HomeController@postChangePassword');

    //routes for system administrations
    Route::group(['prefix' => 'system', 'namespace' => 'SystemSetting'], function() {
        Route::get('users/reset-password/{id}', 'UserController@getResetPassword');
        Route::post('users/reset-password/{id}', 'UserController@postResetPassword');
        Route::resource('modules', 'ModuleController');
        Route::resource('roles', 'RoleController');
        Route::post('users/disable-toggle', 'UserController@postDisableToggle');
        Route::resource('users', 'UserController');
        Route::resource('resend-verification-codes', 'ResendVerificationCodeController');
    });
});




