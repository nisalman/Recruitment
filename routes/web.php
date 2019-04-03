<?php
use Brian2694\Toastr\Facades\Toastr;
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

Route::get('/','HomeController@index')->name('home');
Route::get('/general', 'HomeController@general');
Route::get('/opinion', 'HomeController@general');
Route::get('/contact', 'HomeController@general');

Route::post('/profile', 'ProfileController@save');
Route::get('/profile', 'ProfileController@index');
Route::post('/savePostOffice', 'postOffcieController@savePostOffice');




Route::get('/user', function () {
    return view('index');
})->name('home');

Route::get('/nid-duplicate-checking', 'FormSubmissionController@isDuplicateNID');

Route::resource('/chkdata', 'dumpController');
Route::resource('/application-form', 'FormController')->middleware('auth');
Route::any('/sev/{c}', function ($c) {
    Artisan::call($c);
});
Auth::routes();
route::get('/test', 'updateController@index');
Route::get('/available-jobs','AvailableJobsController@index');
Route::get('/available-jobs/{id}', 'AvailableJobsController@apply');

Route::get('/home', 'HomeController@index')->name('home');
/*Route::post('admin/setup/update-marks', 'MarksController@update');*/
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/check', 'SitplanController@check');

    Route::get('/set-mobile/{mobile}', 'UserController@setMobile');
    Route::resource('/setup/jobs', 'JobsController');
    Route::resource('/setup/sports', 'SportsController');
    Route::resource('/setup/associations', 'AssociationController');
    Route::resource('/setup/federations', 'FederationController');
    Route::resource('/setup/upazila', 'UpazilaController');
    Route::resource('/setup/year', 'YearController');
    Route::resource('/setup/images', 'ClubController');
    Route::resource('/setup/designations', 'DesignationController');
    Route::resource('/setup/organization-position', 'ProfessionController');
    Route::resource('/setup/player-lebel', 'PlayerLebelController');
    Route::resource('/setup/pre_exam', 'PreExamController');
    Route::resource('/setup/center', 'CenterController');
    Route::resource('/setup/room', 'RoomController');

    Route::resource('/setup/sit-plan', 'SitPlanController');
    Route::get('/setup/sit-generate', 'SitPlanController@generate');
    Route::resource('/setup/Form-Setup', 'PlayerTypeController');
    Route::resource('/setup/organizations', 'OrganizationController');
    Route::resource('/users', 'UserController');
    Route::post('/update_user', 'updateController@store');
    Route::post('/form-update', 'updateController@formUpdate');

    Route::get('/delete-user/{$id}', 'updateController@deleteUser');
    Route::get('/setup/marks-entry', 'MarksEntryController@index');

    Route::post('/district-update', 'MarksEntryController@edit');
    Route::resource('/form-submissions', 'FormSubmissionController');
    Route::get('/form-app/check', 'FormSubmissionController@appCheck');
    Route::post('/form-submissions/reorder', 'FormSubmissionController@reorder');
    Route::get('/selected-forms', 'FormSubmissionController@selectedForms');

    Route::post('/dc-application-forward', 'AdminFormSubmissionController@dcApplicationForward');
    Route::post('/mb-application-forward', 'AdminFormSubmissionController@mbApplicationForward');
    Route::post('/send-to-sa', 'AdminFormSubmissionController@ForwardtoSuperAdmin');
    Route::post('/dc-app-delete', 'AdminFormSubmissionController@dcApplicationDelete');
    /*            application list      */

    Route::match(['get', 'post'], '/application-list', 'ApplicationListController@index');
    Route::match(['get', 'post'], '/application-pending', 'ApplicationListController@pending');
    Route::match(['get', 'post'], '/application-pending/application-pending-modal/{id}', 'ApplicationListController@message');
    Route::match(['get', 'post'], '/application-pending/send-message', 'ApplicationListController@sendMessage');

//	Route::match(['get', 'post'],'/dc-pending', 'ApplicationUnsentListController@index');
    /*             report              */

    Route::match(['get', 'post'], '/report/application-report', 'ApplicationReportController@index');
    Route::match(['get', 'post'], '/report/application-user-report-pdf', 'ApplicationReportController@downloadPDF');
    Route::match(['get', 'post'], '/report/application-user-report', 'ApplicationReportController@user_report');
    Route::match(['get', 'post'], '/report/application-report-print', 'ApplicationReportController@indexPrint');
    Route::match(['get', 'post'], '/report/application-user-pending-report', 'ApplicationReportListController@index');

    Route::match(['get', 'post'], '/report/application-user-new-report', 'ApplicationReportController@new');
    Route::match(['get', 'post'], '/report/sit', 'SitReportController@index');

    Route::match(['get', 'post'], '/report/application-user-list-report', 'ApplicationReportListController@list');
    Route::get('/download', 'ApplicationReportListController@export');
    Route::match(['get', 'post'], '/get-total-application', 'ApplicationTotalController@index');
});


// api
Route::group(['prefix' => 'api'], function () {
    Route::get('{model}/{id}/{property}', function ($model, $id, $property) {
        $model = "App\\" . $model;
        $model = new $model();
        $model = $model->find($id);
        $data = $model->{$property};
        return $data;
    });
});

Route::post('/photo/upload', 'FormSubmissionController@upload');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('404', ['as' => '404', 'uses' => 'HomeController@notfound']);
Route::get('500', ['as' => '500', 'uses' => 'HomeController@fatal']);



