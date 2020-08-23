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
Route::get('/', 'DashboardController@index');
Route::get('/404', 'HomeController@page_404');
Route::get('/500', 'HomeController@page_500');
Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['admin', 'user']], function () {
    Route::get('dashboard', 'DashboardController@admin_dashboard');
    Route::post('admin/calendar_event_details', 'DashboardController@calendar_event_details');
    Route::post('admin/calendar', 'DashboardController@bookings_calender');
    Route::post('submit-course-material', 'CourseMaterialController@saveCourseMaterial');
    Route::get('view-course-material/{id}', 'CourseMaterialController@viewCourseMaterial');
});
Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {
    Route::get('account-settings', 'UsersController@getSettings');
    Route::post('account-settings', 'UsersController@saveSettings');
    Route::get('add-material/{id}', 'TrainersController@addAdminMaterial');
});
Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'user'], function () {
    Route::post('trainer/calendar_event_details', 'DashboardController@trainer_calendar_event_details');
    Route::post('trainer/calendar', 'DashboardController@trainer_bookings_calender');
    Route::get('trainer-dashboard', 'DashboardController@trainer_dashboard');
    Route::get('schedule', 'ScheduleController@index');
    Route::post('schedule/calendar_event_details', 'ScheduleController@calendar_event_details');
    Route::post('schedule/calendar', 'ScheduleController@schedule_calender');
    Route::get('add-schedule', 'ScheduleController@add_schedule');
    Route::post('add-schedule-submit', 'ScheduleController@submit_schedule');
    Route::get('trainer-account-settings', 'UsersController@getTrainerSettings');
    Route::post('trainer-account-settings', 'UsersController@saveTrainerSettings');
    Route::get('requested-bookings', 'TrainersController@requestedBookings');
    Route::get('cancel-trainer-booking/{id}', 'TrainersController@cancelBooking');
    Route::get('accept-trainer-booking/{id}', 'TrainersController@acceptBooking');
    Route::get('current-bookings', 'TrainersController@currentBookings');
    Route::get('complete-course/{id}', 'TrainersController@completeCourse');
    Route::post('complete_course_lifecycle', 'TrainersController@completeCourseLifeCycle');
    Route::get('complete-bookings', 'TrainersController@completeBookings');


    Route::get('add-course-material/{id}', 'TrainersController@addMaterial');
});


Route::post('edit_customer_details/{id}', 'BookingsController@customerDetails');

Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {

#Course management
    Route::get('courses', 'CoursesController@index');
    Route::get('create_courses', 'CoursesController@create');
    Route::post('store_courses', 'CoursesController@store');
    Route::get('delete_course/{id}', 'CoursesController@delete');
    Route::get('edit_course/{id}', 'CoursesController@update');
    Route::post('update_course', 'CoursesController@edit');
    Route::get('course_files/{id}', 'CoursesController@course_files');
    Route::get('delete_file/{id}', 'CoursesController@delete_file');

#Trainer management
    Route::get('trainers', 'TrainersController@index');
    Route::get('create_trainer', 'TrainersController@create');
    Route::post('store_trainer', 'TrainersController@store');
    Route::get('delete_trainer/{id}', 'TrainersController@delete');
    Route::get('edit-trainer/{id}', 'TrainersController@update');
    Route::post('update_trainer', 'TrainersController@edit');

#Venue management
    Route::get('venues', 'VenuesController@index');
    Route::get('create_venue', 'VenuesController@create');
    Route::post('store_venue', 'VenuesController@store');
    Route::get('delete_venue/{id}', 'VenuesController@delete');
    Route::get('edit_venue/{id}', 'VenuesController@update');
    Route::get('venue_details/{id}', 'VenuesController@venueDetails');
    Route::post('update_venue', 'VenuesController@edit');

#Customer management
    Route::get('customers', 'CustomersController@index');
    Route::get('create_customer', 'CustomersController@create');
    Route::post('store_customer', 'CustomersController@store');
    Route::get('delete_customer/{id}', 'CustomersController@delete');
    Route::get('edit_customer/{id}', 'CustomersController@update');
    Route::post('update_customer', 'CustomersController@edit');

#Bookings management
    Route::get('bookings', 'BookingsController@index');
    Route::get('create_booking', 'BookingsController@create');
    Route::post('store_booking', 'BookingsController@store');
    Route::post('update_booking', 'BookingsController@edit');
    Route::get('edit_trainer/{id}', 'BookingsController@trainerDetails');
    Route::post('update_booking', 'BookingsController@edit');
    Route::get('get_customer_details/{id}', 'BookingsController@customerDetails');
    Route::get('get_trainer/{course_id}/{venue_id}', 'BookingsController@nearest_trainer');
    Route::get('other_trainer/{trainer_id}', 'BookingsController@other_trainer');
    Route::get('edit_booking/{id}', 'BookingsController@bookingDetals');
    Route::get('booking_details/{id}', 'BookingsController@singleBookingDetals');
    Route::get('venue_fees/{venue_id}', 'BookingsController@venue_fees');
    //Route::get('delete_booking/{id}', 'BookingsController@delete');
#Email management
    Route::get('trainers_email', 'EmailTemplateController@trainer_emails');
    Route::get('customers_email', 'EmailTemplateController@customers_email');
    Route::get('venues_email', 'EmailTemplateController@venues_email');
    Route::get('send_mail/{id}', 'EmailTemplateController@send_mail');
    Route::post('submit_mail', 'EmailTemplateController@submit_mail');
#Permission managementEmailTemplateController@submit_mail
    Route::get('permission-management', 'PermissionController@getIndex');
    Route::get('permission/create', 'PermissionController@create');
    Route::post('permission/create', 'PermissionController@save');
    Route::get('permission/delete/{id}', 'PermissionController@delete');
    Route::get('permission/edit/{id}', 'PermissionController@edit');
    Route::post('permission/edit/{id}', 'PermissionController@update');

    #Role management
    Route::get('role-management', 'RoleController@getIndex');
    Route::get('role/create', 'RoleController@create');
    Route::post('role/create', 'RoleController@save');
    Route::get('role/delete/{id}', 'RoleController@delete');
    Route::get('role/edit/{id}', 'RoleController@edit');
    Route::post('role/edit/{id}', 'RoleController@update');

    #CRUD Generator
    Route::get('/crud-generator', ['uses' => 'ProcessController@getGenerator']);
    Route::post('/crud-generator', ['uses' => 'ProcessController@postGenerator']);

    # Activity log
    Route::get('activity-log', 'LogViewerController@getActivityLog');
    Route::get('activity-log/data', 'LogViewerController@activityLogData')->name('activity-log.data');

    #User Management routes
    Route::get('users', 'UsersController@getIndex');
    Route::get('user/create', 'UsersController@create');
    Route::post('user/create', 'UsersController@save');
    Route::get('user/edit/{id}', 'UsersController@edit');
    Route::post('user/edit/{id}', 'UsersController@update');
    Route::get('user/delete/{id}', 'UsersController@delete');
    Route::get('user/deleted/', 'UsersController@getDeletedUsers');
    Route::get('user/restore/{id}', 'UsersController@restoreUser');
});

//Log Viewer
Route::get('log-viewers', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@index')->name('log-viewers');
Route::get('log-viewers/logs', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@listLogs')->name('log-viewers.logs');
Route::delete('log-viewers/logs/delete', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@delete')->name('log-viewers.logs.delete');
Route::get('log-viewers/logs/{date}', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@show')->name('log-viewers.logs.show');
Route::get('log-viewers/logs/{date}/download', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@download')->name('log-viewers.logs.download');
Route::get('log-viewers/logs/{date}/{level}', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@showByLevel')->name('log-viewers.logs.filter');
Route::get('log-viewers/logs/{date}/{level}/search', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@search')->name('log-viewers.logs.search');
Route::get('log-viewers/logcheck', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@logCheck')->name('log-viewers.logcheck');


Route::get('auth/{provider}/', 'Auth\SocialLoginController@redirectToProvider');
Route::get('{provider}/callback', 'Auth\SocialLoginController@handleProviderCallback');
Route::get('logout', 'Auth\LoginController@logout');
Auth::routes();
Route::get('phpinfo', function () {
    Illuminate\Support\Facades\Artisan::call('cache:clear');
});
Route::get('connection-test', function () {
    $booking = new \App\Http\Controllers\BookingsController();
    echo'<pre>';
    print_R($booking->search_location('231 Aldborough Rd S Ilford IG3 8HZ UK IG3 8HZ'));
    echo'</pre>';
});
Route::get('send_email', function () {
    try {
        $email = new \App\Http\Controllers\MailController();
        $email->sendMail('m.anis@blssol.com', 'Test Email', 'customer_confirm_booking');
    } catch (\Exception $ex) {
        echo $ex->getMessage();
    }
});



