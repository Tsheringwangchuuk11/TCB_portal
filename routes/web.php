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
	Route::get('dashboard', 'HomeController@getDashboard')->name('dashboard');
	Route::get('profile', 'HomeController@getProfile');
    Route::get('change-password', 'HomeController@getChangePassword')->name('change-password');
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

    //create route by grouping..example like below.
    //routes for masters
    Route::group(['prefix' => 'master', 'namespace' => 'Master'], function() {

    });

    // fileupload
    Route::post('documentattach', 'Services\FileUploadController@addDocuments');
    Route::post('deletefile', 'Services\FileUploadController@deleteFile');

    Route::get('/home/get-services', 'HomeController@getServices');
    Route::get('/home/get-modules', 'HomeController@getModules');
    //checkList
    Route::post('service-create/get-checklist', 'Services\ServiceController@getCheckList');
    // services
    Route::resource('service-create/{page_link}', 'Services\ServiceController');
});




