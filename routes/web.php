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
	Route::post('update-profile/{id}', 'HomeController@updateProfile');
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
        Route::get('backups', 'BackupController@getIndex');
        Route::post('backups/create', 'BackupController@postCreate');
        Route::post('backups/delete', 'BackupController@postDelete');
        Route::post('backups/remove-file/{file}', 'BackupController@postRemoveFile');
        Route::get('backups/download/{file}', 'BackupController@getDownload');
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
        Route::post('get-restaurantchapters', 'ServiceController@getRestaurantCheckListChapter');
        Route::post('save-application', 'ServiceController@saveNewApplication');
        Route::post('save-grievance-application', 'ServiceController@saveGrievanceApplication');
        Route::get('get-hotel-details/{id}', 'ServiceController@getTouristHotelDetails');
        Route::get('get-tour_operator-details/{id}', 'ServiceController@getTourOperatorDetails');
        Route::get('get-tour_operator-info/{cid}', 'ServiceController@getTourOperatorInfo');
        Route::get('get-companyname', 'ServiceController@getCompnayName');
        Route::get('get-homestays-details/{cidid}', 'ServiceController@getVillageHomeStayDetails');

        // fileuploads
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
        Route::post('renew-hotel-license', 'TouristStandardHotelController@hotelLicenseRenewApplication');
        Route::post('hotel-ownership-change', 'TouristStandardHotelController@hotelOwnerShipChangeApplication');
        Route::post('hotel-name-change', 'TouristStandardHotelController@hotelNameChangeApplication');
        Route::post('hotel-license-cancel', 'TouristStandardHotelController@hotelLicenseCancelApplication');
        //village home stay
        Route::get('village-homestay/{applicationNo}', 'VillageHomeStayController@getApplicationDetails')->name('villagehomestay');
        Route::post('village-home-stay-assessment', 'VillageHomeStayController@villageHomeStayAssessmentApplication');
        Route::post('village-home-stay-license-renew', 'VillageHomeStayController@villageHomeStayLicenseRenewApplication');
        
        //restaurant
        Route::get('restaurant/{applicationNo}', 'RestaurantController@getApplicationDetails')->name('restaurant');
        Route::post('restaurant-assessment', 'RestaurantController@restaurantAssessmentApplication');
        Route::post('restuarant-name-change', 'RestaurantController@restaurantNameChangeApplication');
        Route::post('restuarant-owner-change', 'RestaurantController@restaurantOwnerChangeApplication');
        Route::post('restuarant-license-renew', 'RestaurantController@restaurantLicenseRenewApplication');
        Route::post('restuarant-license-cancel', 'RestaurantController@restaurantLicenseCancelApplication');

       //tour operator
        Route::get('tour-operator/{applicationNo}', 'TourOperatorController@getApplicationDetails')->name('touropertor');
        Route::post('operator-technical-clearance', 'TourOperatorController@tourOperatorTechnicalClearanceApplication');
        Route::post('tour-operator-assessment', 'TourOperatorController@tourOperatorAssessmentApplication');
        Route::post('proprieter-card', 'TourOperatorController@proprieterCardApplication');
        Route::post('tour-operator-owner_change', 'TourOperatorController@tourOperatorOwnerChangeApplication');
        Route::post('tour-operator-name_change', 'TourOperatorController@tourOperatorNameChangeApplication');
        Route::post('tour-operator-license-renew', 'TourOperatorController@tourOperatorLicenseRenewApplication');
        Route::post('recommandation_letter_for_to_license', 'TourOperatorController@toLicenseRecommandationLetterApplication');
        Route::post('travel_fairs', 'TourOperatorController@travelFairsApplication');
        Route::get('generate_letter_sample/{applicationNo}', 'TourOperatorController@getRecommandationLetterSample');
        //Media
        Route::get('media/{applicationNo}', 'MediaController@getApplicationDetails')->name('media');
        Route::post('fam', 'MediaController@famApplication');
        Route::post('tour-operator-fam', 'MediaController@TourOperatorfamApplication');

        //tourism product
        Route::get('tourism-product-development/{applicationNo}', 'TourismProductController@getApplicationDetails')->name('tourismproductdevelopment');
        Route::post('tourism-product-development', 'TourismProductController@tourismProductDevelopmentApplication');
        Route::post('product-proposal', 'TourismProductController@tourismProductProposalApplication');

    });
  //routes for grievance redressal
  Route::group(['prefix' => 'feedback', 'namespace' => 'FeedBack'], function() {
    Route::get('grievance-redressal', 'GrievanceRedressalController@getGrievanceRedressalList');
    Route::get('openApplication/{applicationNo}', 'GrievanceRedressalController@openApplication');
    });

    //routes for report
    Route::group(['prefix' => 'report', 'namespace' => 'Report'], function() {
        Route::get('assessment-reports', 'AssessmentReportController@getAssessment');
        Route::get('application-lists', 'AssessmentReportController@getApplicationList');
        Route::get('assessment-reports/{application_no}', 'AssessmentReportController@detailAssessment');
    });

    Route::group(['prefix' => 'statistics', 'namespace' => 'Statistics'], function() {
        Route::get('arrival', function(){return view('report.arrival');});
    });

    //routes for new application
    Route::group(['prefix' => 'events', 'namespace' => 'EventRegistation'], function() {
        Route::resource('travel-fairs-event', 'EventRegistrationController');
    });

     //routes for uploads
     Route::group(['prefix' => 'excel', 'namespace' => 'Excel'], function() {
        Route::resource('uploads', 'ExcelUploadController');
     });
});




