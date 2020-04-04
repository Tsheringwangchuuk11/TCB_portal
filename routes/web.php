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
    return view('index');
});

 Auth::routes();
 Route::get('/home', 'HomeController@index')->name('home');

 Route::get('/home/get-services', 'HomeController@getServices');
 Route::get('/home/get-modules', 'HomeController@getModules');
//checkList
Route::post('service-create/get-checklist', 'Services\ServiceController@getCheckList');
// services
  Route::resource('service-create/{page_link}', 'Services\ServiceController');
 




