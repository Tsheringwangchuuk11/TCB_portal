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
    Route::get('feedback', 'HomeController@feedBack')->name('feedback');
    Route::post('save-grievance-application', 'HomeController@saveGrievanceApplication');
    Route::get('contact_us', function(){return view('frontend.layouts.contact_us');});
    Route::get('about_us', function(){return view('frontend.layouts.about_us');});
    Route::get('training-registration','TrainingRegistrationController@displayCourseDtlsToEndUser');
    Route::get('registration-for-training/{id}','TrainingRegistrationController@registrationForTraining');
    Route::post('save-trainee-dtls','TrainingRegistrationController@saveTraineeDtls');
});

//public reports
Route::group(['prefix' => 'report', 'namespace' => 'Report'], function () {
    Route::get('public-report', 'PublicReportController@index');
    Route::get('reports', 'PublicReportController@ajaxReports');
});

//APIs
Route::group(['prefix' => 'api', 'namespace' => 'Api'], function () {
    Route::get('get_citizen_details', 'DcrcController@getCitizenDetails');
});
// fileuploads
Route::post('/documentattach', 'FileUploadController@addDocuments');
//delete upload files
Route::post('/deletefile', 'FileUploadController@deleteFile');

//dropdown controller
Route::get('/json-dropdown', 'DropdownController@getDropdownList');

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

    //routes for new application
    Route::group(['prefix' => 'application', 'namespace' => 'Application'], function() {
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
        Route::get('recommendation-letter/{application_no}/{service_id}/{module_id}', 'ServiceController@printRecommendationLetter');
    });

     //routes for resubmit application
     Route::group(['prefix' => 'application', 'namespace' => 'Application'], function() {
        Route::post('save-resubmit-application', 'ResubmitServiceController@saveResubmitApplication');
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
        Route::get('tourist-standard-hotel/{applicationNo}/{status?}', 'TouristStandardHotelController@getApplicationDetails')->name('touriststandardhotel');
        Route::post('technical-clearance', 'TouristStandardHotelController@hotelTechnicalClearanceApplication');
        Route::post('standard-hotel-assessment', 'TouristStandardHotelController@standardHotelAssessmentApplication');
        Route::post('name-ownership-cancellation-for-hotel', 'TouristStandardHotelController@hotelNameOwnershipCancellationApplication');
        Route::post('import-license-for-hotel', 'TouristStandardHotelController@importLicenseApplication');
        Route::post('work-permit', 'TouristStandardHotelController@workPermitApplication');
        
        //village home stay
        Route::get('village-homestay/{applicationNo}/{status?}', 'VillageHomeStayController@getApplicationDetails')->name('villagehomestay');
        Route::post('village-home-stay-assessment', 'VillageHomeStayController@villageHomeStayAssessmentApplication');
        Route::post('village-home-stay-license-cancel', 'VillageHomeStayController@villageHomeStayLicenseCancelApplication');

        //restaurant
        Route::get('restaurant/{applicationNo}/{status?}', 'RestaurantController@getApplicationDetails')->name('restaurant');
        Route::post('restaurant-assessment', 'RestaurantController@restaurantAssessmentApplication');
        Route::post('restuarant-name-owbership-change', 'RestaurantController@restaurantNameAndOwnershipChangeApplication');

       //tour operator
        Route::get('tour-operator/{applicationNo}/{status?}', 'TourOperatorController@getApplicationDetails')->name('touropertor');
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
        Route::post('fam', 'MediaController@famApplication');
        Route::post('tour-operator-fam', 'MediaController@TourOperatorfamApplication');

        //tourism product
        Route::get('tourism-product-development/{applicationNo}/{status?}', 'TourismProductController@getApplicationDetails')->name('tourismproductdevelopment');
        Route::post('eoi', 'TourismProductController@tourismProductEOIApplication');
        Route::post('new-tourism-product-development', 'TourismProductController@newTourismProductDevelopment');
        Route::post('existing-tourism-product-development', 'TourismProductController@existingTourismProductProposal');

        //tented accommodation
        Route::get('tended-accommodation/{applicationNo}/{status?}', 'TentedAccommodationController@getApplicationDetails')->name('tendedaccommodation');
        Route::post('tented-accommdation-assessment', 'TentedAccommodationController@tentedAccommAssessmentApplication');

        //Tourism Events
        Route::get('tourism-event/{applicationNo}', 'TourismEventController@getApplicationDetails')->name('tourismevent');
        Route::post('travel_fairs', 'TourismEventController@travelFairsApplication');
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
        Route::get('assessment-reports/{application_no}/{moduleId}', 'AssessmentReportController@detailAssessment');
    });

    //statistical report
    Route::group(['prefix' => 'statistics', 'namespace' => 'StatisticalReport'], function() {
        Route::get('arrival', 'StatisticController@index');
    });

    //routes for event registration
    Route::group(['prefix' => 'events', 'namespace' => 'EventRegistation'], function() {
        Route::resource('travel-fairs-event', 'EventRegistrationController');
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




