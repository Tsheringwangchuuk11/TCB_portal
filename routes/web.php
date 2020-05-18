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
	Route::get('/json-dropdown', 'HomeController@getDropdownLists');

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

    //routes for masters
    Route::group(['prefix' => 'master', 'namespace' => 'Master'], function() {
        Route::resource('checklist-chapters', 'ChecklistChapterController');
        Route::get('checklist-areas/module', 'ChecklistAreaController@getChapter');
        Route::resource('checklist-areas', 'ChecklistAreaController');
        Route::get('checklist-standards/chapter', 'ChecklistStandardController@getChecklistArea');
        Route::resource('checklist-standards', 'ChecklistStandardController');
    });

    //routes for new application
    Route::group(['prefix' => 'application', 'namespace' => 'Application'], function() {
		Route::get('new-application', 'ServiceController@getModules');
		Route::get('get-services', 'ServiceController@getServices');
        Route::get('service-create/{page_link}', 'ServiceController@getServiceForm');
        Route::post('get-chapters', 'ServiceController@getCheckListChapter');
        Route::post('get-homestaychapters', 'ServiceController@getHomeStayCheckListChapter');
        Route::post('save-application', 'ServiceController@saveNewApplication');
        Route::get('get-ownership-details/{id}', 'ServiceController@getOwnerShipDetails');
        // fileupload
        Route::post('documentattach', 'FileUploadController@addDocuments');
        Route::post('deletefile', 'FileUploadController@deleteFile');
    });

    //routes for task list
    Route::group(['prefix' => 'tasklist', 'namespace' => 'Tasklist'], function() {
        Route::resource('tasklist', 'TasklistController');
        Route::get('claimApplication', 'TasklistController@claimApplication');
        Route::get('releaseApplication', 'TasklistController@releaseApplication');
    });
    //routes for approver
    Route::group(['prefix' => 'verification', 'namespace' => 'Approver'], function() {
        Route::get('openApplication/{applicationNo}/{serviceId}/{moduleId}', 'OpenApplicationController@openApplication');
        //tourist standard hotel
        Route::get('tourist-standard-hotel/{applicationNo}', 'TouristStandardHotelController@getApplicationDetails')->name('touriststandardhotel');
        Route::post('technical-clearance', 'TouristStandardHotelController@hotelTechnicalClearanceApplication');
        Route::post('standard-hotel-assessment', 'TouristStandardHotelController@standardHotelAssessmentApplication');
        //village home stay
        Route::get('village-homestay/{applicationNo}', 'VillageHomeStayController@getApplicationDetails')->name('villagehomestay');
        Route::post('village-home-stay-assessment', 'VillageHomeStayController@villageHomeStayAssessmentApplication');

        //restaurant
        Route::get('restaurant/{applicationNo}', 'RestaurantController@getApplicationDetails')->name('restaurant');
       //tour operator
        Route::get('tour-operator/{applicationNo}', 'TourOperatorController@getApplicationDetails')->name('touropertor');
        Route::post('operator-technical-clearance', 'TourOperatorController@tourOperatorTechnicalClearanceApplication');
        Route::post('tour-operator-assessment', 'TourOperatorController@tourOperatorAssessmentApplication');
        //Media
        Route::get('media/{applicationNo}', 'MediaController@getApplicationDetails')->name('media');
        //tourism product
        Route::get('tourism-product-development/{applicationNo}', 'TourismProductController@getApplicationDetails')->name('tourismproductdevelopment');
       
    });
});




