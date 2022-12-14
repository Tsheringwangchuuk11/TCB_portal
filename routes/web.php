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
    Route::get('tourism-grievances', 'HomeController@tourismGrievances')->name('tourism-grievances');
    Route::post('save-grievance-application', 'HomeController@saveGrievanceApplication');
    Route::get('contact_us', function(){return view('frontend.layouts.contact_us');});
    Route::get('about_us', 'HomeController@aboutUsContent');
    Route::get('training-registration','TrainingRegistrationController@displayCourseDtlsToEndUser');
    Route::get('registration-for-training/{id}','TrainingRegistrationController@registrationForTraining');
    Route::post('save-trainee-dtls','TrainingRegistrationController@saveTraineeDtls');
    Route::get('feedback', function(){return view('frontend.feedback');});
    Route::get('getmapdata', 'HomeController@getVisitorsCountryWise');
    Route::post('contact-post', 'HomeController@contactPost');
});

//public reports
Route::group(['prefix' => 'report', 'namespace' => 'Report'], function () {
    Route::get('public-report/{id}', 'PublicReportController@index');
    Route::get('reports', 'PublicReportController@ajaxReports');
});
//login_page_for_all_users
Route::get('/user_login', 'MainController@user_login');
Route::post('register', 'MainController@register');
Route::post('/enduser_dashboard', 'MainController@checklogin');
Route::get('/logout', 'MainController@logout')->name('logout');
//public user
// Route::group(['namespace'=>'EndUser'], function () {
//     Route::get('sso/redirect', 'ApplicationTokenController@oAuthRedirect');
//     Route::get('sso/enduser_dashboard', 'ApplicationTokenController@callBack');
//     Route::post('signout', 'ApplicationTokenController@logout')->name('signout');
//     Route::get('sso/logout', 'ApplicationTokenController@logoutCallBack');
    
// });

//route for the end user services
Route::group(['middleware' => ['auth']], function () {
    Route::group(['namespace' => 'EndUser'], function() {
        Route::get('/enduser_dashboard', 'EnduserController@getApplicationDetails')->name('enduser_dashboard');
    });
    Route::group(['prefix' => 'application','namespace' => 'EndUser'], function() {
        //route for new application
        Route::get('new-application', 'ServiceController@getModules');
        Route::get('get-tech-clearance-dtls/{dispatch_no}', 'ServiceController@getTechCleranceDtls');
        Route::get('get-services', 'ServiceController@getServices');
        Route::get('check-dispatch-number', 'ServiceController@checkDispatchNumber');
        Route::get('service-create/{page_link}', 'ServiceController@getServiceForm');
        Route::post('get-hotel-checklist', 'ServiceController@getHotelCheckList');
        Route::post('get-checklist', 'ServiceController@getCheckList');
        Route::post('save-application', 'ServiceController@saveNewApplication');
        Route::post('save-grievance-application', 'ServiceController@saveGrievanceApplication');
        Route::get('get-hotel-details/{id}', 'ServiceController@getTouristHotelDetails');
        Route::get('get-companyname', 'ServiceController@getCompnayName');
        Route::get('get-homestays-details/{cid}', 'ServiceController@getVillageHomeStayDetails');
        Route::get('get-event-details/{id}/{serviceId}/{moduleId}', 'ServiceController@getEventRegisteredDetails');
        Route::get('delete-data-record', 'ServiceController@deleteDataRecord');
        Route::get('get-work-permit-dtls', 'ServiceController@getWorkPermitDtls');
        Route::get('get-foreign-worker-dtls', 'ServiceController@getForeignWorkerDtls');
        Route::get('check-partner-cid-no', 'ServiceController@checkPartnerCIDNumber');

        //print recommendation letter
        Route::get('recommendation-letter/{application_no}/{service_id}/{module_id}/{application_type_id}', 'ServiceController@printRecommendationLetter');
        //route for resubmit application
        Route::post('save-resubmit-application', 'ResubmitServiceController@saveResubmitApplication');
    });
});


//APIs
Route::group(['prefix' => 'api', 'namespace' => 'Api'], function () {
    Route::get('get_citizen_details', 'DcrcController@getCitizenDetails');

    //Hotels Api
    Route::get('hotels-list', 'DcrcController@getHotelsList');
    Route::get('hotels-details/{hotel_id}', 'DcrcController@getHotelDetails');
    Route::get('hotels-search-category/{category_id}', 'DcrcController@getHotelCategoryList');
    Route::get('hotels-search-region/{region_id}', 'DcrcController@getHotelRegionList');

    //Home Stays Api
    Route::get('home-stay-list', 'DcrcController@getHomeStayList');
    Route::get('home-stay-details', 'DcrcController@getHomeStayDetails');
    Route::get('home-stay-search-region', 'DcrcController@getHomeStayRegionList');

    //Tented Accomadation Api
    Route::get('tented-acc-list', 'DcrcController@getTentedAccList');
    Route::get('tented-acc-details', 'DcrcController@getTentedAccDetails');
    Route::get('tented-acc-search-region', 'DcrcController@getTentedAccRegionList');

    //Motor Cycle Rental Api
    Route::get('motor-cycle-list', 'DcrcController@getMotorCycleList');
    Route::get('motor-cycle-details', 'DcrcController@getMotorCycleDetails');
    Route::get('motor-cycle-search-region', 'DcrcController@getMotorCycleRegionList');

    //Car Rental Api
    Route::get('car-rental-list', 'DcrcController@getCarRentalList');
    Route::get('car-rental-details', 'DcrcController@getCarRentalDetails');
    Route::get('car-rental-search-region', 'DcrcController@getCarRentalRegionList');

    //Bus Rental Api
    Route::get('bus-rental-list', 'DcrcController@getBusRentalList');
    Route::get('bus-rental-details', 'DcrcController@getBusRentalDetails');
    Route::get('bus-rental-search-region', 'DcrcController@getBusRentalRegionList');
});
// fileuploads
Route::post('/documentattach', 'FileUploadController@addDocuments');
//delete upload files
Route::post('/deletefile', 'FileUploadController@deleteFile');

//dropdown controller
Route::get('/json-dropdown', 'DropdownController@getDropdownList');
Route::get('/report-dropdown', 'DropdownController@getReportDropdownList');

Route::group(['middleware' => ['auth']], function () {
	Route::get('dashboard', 'HomeController@getDashboard')->name('dashboard');
	Route::get('profile', 'HomeController@getProfile');
	Route::post('update-profile/{id}', 'HomeController@updateProfile');
    Route::get('change-password', 'HomeController@getChangePassword')->name('change-password');
    Route::post('change-password', 'HomeController@postChangePassword');
    Route::get('/json-basicstandard', 'HomeController@getBasicStandardLists');

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
        Route::resource('about-us-content', 'AboutUsContent');
        Route::post('image_upload', 'AboutUsContent@upload');
        Route::post('delete_upload_image', 'AboutUsContent@DeleteUploadImage');
    });

    //routes for masters
    Route::group(['prefix' => 'master', 'namespace' => 'Master'], function() {
        Route::resource('checklist-chapters', 'ChecklistChapterController');
        Route::get('checklist-areas/module', 'ChecklistAreaController@getChapter');
        Route::resource('checklist-areas', 'ChecklistAreaController');
        Route::get('checklist-standards/chapter', 'ChecklistStandardController@getChecklistArea');
        Route::resource('checklist-standards', 'ChecklistStandardController');
        Route::resource('drop-down-master', 'DropDownController');
        Route::resource('producttypes', 'ProductTypesController');
        Route::get('basic-standard', 'ChecklistStandardController@getBasicStandardDtls');
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
        Route::get('viewApplication/{applicationNo}/{serviceId}/{moduleId}', 'OpenApplicationController@viewApplication');
       
        //tourist standard hotel
        Route::get('tourist-standard-hotel/{applicationNo}/{status?}', 'TouristStandardHotelController@getApplicationDetails')->name('touriststandardhotel');
        Route::post('technical-clearance', 'TouristStandardHotelController@hotelTechnicalClearanceApplication');
        Route::post('standard-hotel-assessment', 'TouristStandardHotelController@standardHotelAssessmentApplication');
        Route::post('name-ownership-cancellation-for-hotel', 'TouristStandardHotelController@hotelNameOwnershipCancellationApplication');
        Route::post('import-license-for-hotel', 'TouristStandardHotelController@importLicenseApplication');
        Route::post('work-permit', 'TouristStandardHotelController@workPermitApplication');
        Route::get('tourist-standard-hotel-details/{applicationNo}/{status?}', 'TouristStandardHotelController@viewApplicationDetails')->name('touriststandardhoteldetails');
        
        //village home stay
        Route::get('village-homestay/{applicationNo}/{status?}', 'VillageHomeStayController@getApplicationDetails')->name('villagehomestay');
        Route::get('village-homestay-details/{applicationNo}/{status?}', 'VillageHomeStayController@viewApplicationDetails')->name('villagehomestaydetails');
        Route::post('village-home-stay-assessment', 'VillageHomeStayController@villageHomeStayAssessmentApplication');
        Route::post('village-home-stay-license-cancel', 'VillageHomeStayController@villageHomeStayLicenseCancelApplication');

        //restaurant
        Route::get('restaurant/{applicationNo}/{status?}', 'RestaurantController@getApplicationDetails')->name('restaurant');
        Route::get('restaurantdetails/{applicationNo}/{status?}', 'RestaurantController@viewApplicationDetails')->name('restaurantdetails');
        Route::post('restaurant-assessment', 'RestaurantController@restaurantAssessmentApplication');
        Route::post('restuarant-name-owbership-change', 'RestaurantController@restaurantNameAndOwnershipChangeApplication');

       //tour operator
        Route::get('tour-operator/{applicationNo}/{status?}', 'TourOperatorController@getApplicationDetails')->name('touropertor');
        Route::get('tour-operator-details/{applicationNo}/{status?}', 'TourOperatorController@viewApplicationDetails')->name('touropertordetails');
        Route::post('operator-technical-clearance', 'TourOperatorController@tourOperatorTechnicalClearanceApplication');
        Route::post('tour-operator-assessment', 'TourOperatorController@tourOperatorAssessmentApplication');
        Route::post('proprieter-card', 'TourOperatorController@proprieterCardApplication');
        Route::post('tour-operator-name-owner-location-change', 'TourOperatorController@tourOperatorOwnerNameLocationChangeApplication');
        Route::post('import-license-for-to', 'TourOperatorController@recommendationLetterImportLicense');
        Route::post('tour-operator-license-renew-clearance', 'TourOperatorController@tourOperatorLicenseRenewClearance');
        Route::post('rec_letter_tourism_industry-partner', 'TourOperatorController@tourismIndustryPartner');

        Route::get('generate_letter_sample/{applicationNo}', 'TourOperatorController@getRecommandationLetterSample');
        Route::get('recommendation-letter', 'TourOperatorController@getAppListForRecoomendationLetter');
        Route::get('view-recommendation-letter/{applicationNo}', 'TourOperatorController@viewRecoomendationLetter');
        Route::get('print-recommendation-letter/{applicationNo}', 'TourOperatorController@printRecoomendationLetter');
        Route::get('update-print_status/{applicationNo}', 'TourOperatorController@updatePrintStatus');
       
        //Media
        Route::get('media/{applicationNo}', 'MediaController@getApplicationDetails')->name('media');
        Route::get('mediadetails/{applicationNo}', 'MediaController@viewApplicationDetails')->name('mediadetails');
        Route::post('fam', 'MediaController@famApplication');
        Route::post('tour-operator-fam', 'MediaController@TourOperatorfamApplication');

        //tourism product
        Route::get('tourism-product-development/{applicationNo}/{status?}', 'TourismProductController@getApplicationDetails')->name('tourismproductdevelopment');
        Route::get('tourism-product-development-details/{applicationNo}/{status?}', 'TourismProductController@viewApplicationDetails')->name('tourismproductdevelopmentdetails');
        Route::post('eoi', 'TourismProductController@tourismProductEOIApplication');
        Route::post('new-tourism-product-development', 'TourismProductController@newTourismProductDevelopment');
        Route::post('existing-tourism-product-development', 'TourismProductController@existingTourismProductProposal');

        //tented accommodation
        Route::get('tended-accommodation/{applicationNo}/{status?}', 'TentedAccommodationController@getApplicationDetails')->name('tendedaccommodation');
        Route::get('tended-accommodation-details/{applicationNo}/{status?}', 'TentedAccommodationController@viewApplicationDetails')->name('tendedaccommodationdetails');
        Route::post('tented-accommdation-assessment', 'TentedAccommodationController@tentedAccommAssessmentApplication');
        Route::post('name-ownership-cancellation-for-tented-accom', 'TentedAccommodationController@tentedAccommodationNameOwnershipCancellationApplication');


        //Tourism Events
        Route::get('tourism-event/{applicationNo}', 'TourismEventController@getApplicationDetails')->name('tourismevent');
        Route::get('tourism-event-details/{applicationNo}', 'TourismEventController@viewApplicationDetails')->name('tourismeventdetails');
        Route::post('travel_fairs', 'TourismEventController@travelFairsApplication');
    });
    //routes for grievance redressal
    Route::group(['prefix' => 'feedback', 'namespace' => 'FeedBack'], function() {
        Route::get('grievances-redressal/{applicationNo}/{status?}', 'GrievanceRedressalController@getApplicationDetails')->name('grievancesredressal');
        Route::get('grievances-redressal-details/{applicationNo}/{status?}', 'GrievanceRedressalController@viewApplicationDetails')->name('grievancesredressaldetails');
        Route::get('openApplication/{applicationNo}', 'GrievanceRedressalController@openApplication');
        Route::post('approved-grievance-application', 'GrievanceRedressalController@approvedGrievanceRedressalApplication');
    });

    //routes for report
    Route::group(['prefix' => 'report', 'namespace' => 'Report'], function() {
        Route::get('assessment-reports', 'AssessmentReportController@getAssessment');
        Route::get('assessment-reports/{application_no}/{moduleId}', 'AssessmentReportController@detailAssessment');
        Route::get('application-lists', 'CommonReportController@getApplicationList');
        Route::get('training', 'CommonReportController@reportForTraining');
        Route::get('registration', 'CommonReportController@reportForRegistration');
        Route::get('arrival', 'StatisticController@index');
        Route::get('tourism_survey', 'CommonReportController@tourismSurvey');
        Route::get('get-report-content/{report_type_id}/{report_category_id}/{report_name_id}/{year}/{print?}', 'CommonReportController@getReportContent');
    });
    //routes for event registration
    Route::group(['prefix' => 'events', 'namespace' => 'EventRegistation'], function() {
        Route::resource('travel-fairs-event', 'EventRegistrationController');
    });

     // route for statistical report data entry 
     Route::group(['prefix' => 'statistical', 'namespace' => 'StatisticalReport'], function() {
         //key highlight
        Route::resource('key-highlights', 'KeyHighlightsController');
        //purpose survey
        Route::get('purpose-survey', 'PurposeSurveyController@index');
        Route::get('show-purpose-survey/{report_type_id}/{report_category_id}/{reportvisitor_type_id}', 'PurposeSurveyController@show');
        Route::get('create-purpose-survey/{report_type_id}/{report_category_id}/{reportvisitor_type_id}', 'PurposeSurveyController@create');
        Route::post('store-purpose-survey', 'PurposeSurveyController@store');
        Route::get('edit-purpose-survey/{id}', 'PurposeSurveyController@edit');
        Route::post('update-purpose-survey', 'PurposeSurveyController@update');
        Route::delete('delete-purpose-survey', 'PurposeSurveyController@destroy');
        //transportation mode
        Route::resource('transportation', 'TransportationModeController');
        //trip expenditure survey
        Route::resource('trip-expenditure', 'TripExpenditureController');
        //package option survey
        Route::resource('package-option', 'PackageOptionController');
        //origin survey
        Route::resource('origin', 'OriginController');
        //total trip expenditure survey
        Route::get('total-trip-expenditure', 'TotalTripExpController@index');
        Route::get('show-total-trip-exp/{report_type_id}/{reportvisitor_type_id}', 'TotalTripExpController@show');
        Route::get('create-total-trip-exp/{report_type_id}/{reportvisitor_type_id}', 'TotalTripExpController@create');
        Route::post('store-total-trip-exp', 'TotalTripExpController@store');
        Route::get('edit-total-trip-exp/{id}', 'TotalTripExpController@edit');
        Route::post('update-total-trip-exp', 'TotalTripExpController@update');
        Route::delete('delete-total-trip-exp', 'TotalTripExpController@destroy');
    });

    //routes for course
    Route::group(['prefix' => 'course', 'namespace' => 'Course'], function() {
        //cousre dtls
        Route::get('course-details', 'CourseController@getCourseDtlsList');
        Route::get('course-create','CourseController@createNewCourse');
        Route::post('store-course-dtls','CourseController@storeNewCourse');
        Route::get('course-edit/{id}','CourseController@editCourseDtls');
        Route::post('update-course-dtls','CourseController@updateCourseDtls');
        Route::delete('delete-course/{id}','CourseController@deleteCourseDtls');

        //Trainee dtls
        Route::get('trainee-list', 'CourseController@getTraineeDtlsList');
        Route::get('trainee-apply-list/{course_dtl_id}', 'CourseController@getTraineeRegistrationList');
        Route::get('selected-status-update/{application_no}/{course_dtl_id}', 'CourseController@selectedStatusUpdate');
        Route::get('view-submitted-trainee-dtls/{application_no}/{status}', 'CourseController@viewSubmittedTraineeList');
        Route::post('update_status', 'CourseController@updateStatus');
    });
    
    //routes for uploads excel files
    Route::group(['prefix' => 'excel', 'namespace' => 'Excel'], function() {
    Route::resource('uploads', 'ExcelUploadController');
    });

    

});




