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

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/view-notes', 'HomeController@viewNotes')->name('viewNotes');
Route::get('/view-notes/{sem_id}', 'HomeController@getSubjects')->name('getSubjects');
Route::get('/view-notes/{sem_id}/{sub_id}', 'HomeController@getNotes')->name('getNotes');

Route::get('/view-mcq', 'StudentMCQController@viewSem')->name("viewMcq");
Route::get('/view-mcq/{sem_id}', 'StudentMCQController@viewSub');
Route::get('/view-mcq/{sem_id}/{sub_id}', 'StudentMCQController@viewMcqs');

Route::get('/mcq/answer-mcq/{id}', 'StudentMCQController@answer');
Route::post('/mcq/answer-mcq/{id}', 'StudentMCQController@submit');

Route::get('/view-videos', 'HomeController@viewSemVideos')->name('viewSemVideos');
Route::get('/view-videos/{sem_id}', 'HomeController@viewSubVideos')->name('viewSubVideos');
Route::get('/view-videos/{sem_id}/{sub_id}', 'HomeController@getVideos')->name('getVideos');

Route::get('/view-assignment', 'HomeController@viewSemAssignment')->name('viewSemVideos');
Route::get('/view-assignment/{sem_id}', 'HomeController@viewSubAssignment')->name('viewSubAssignment');
Route::get('/view-assignment/{sem_id}/{sub_id}', 'HomeController@getAssignment')->name('getAssignment');

Route::get('/view-scholarship', 'HomeController@viewScholarship')->name('viewScholarship');
Route::get('/view-events', 'HomeController@viewEvents')->name('viewEvents');
 
Route::get("/register-event/{id}","HomeController@registerEvent");

Route::get('/answer-assignment/{assign_id}', 'StudentAssignmentController@answerAssignment')->name('answerAssignment');
Route::post('/submit-assignment', 'StudentAssignmentController@submitAssignment')->name('submitAssignment');

Route::get("/send-notes","HomeController@sendNotes");
Route::get("/sent-notes/delete/{id}","HomeController@delNotes");
Route::get("/view-sent-notes","HomeController@viewSentNotes")->name("viewSentNote");
Route::post("/upload-notes","HomeController@uploadNotes")->name("uploadNotes");

Route::prefix('staff')->group(function() {
    Route::get('/login', 'Auth\StaffLoginController@showLoginForm')->name('staff.login');
    Route::post('/login', 'Auth\StaffLoginController@login')->name('staff.login.submit');
    Route::get('/dashboard', 'StaffController@index')->name('staff.dashboard');
    Route::get('/subject/create', 'StaffController@create')->name('staff.create');
    Route::get('/subject/delete/{id}', 'StaffController@delete')->name('staff.delete');
    Route::post('/addSubject', 'StaffController@addSubject')->name('staff.addSubject');

    Route::resource('notes', 'StaffNotesController');
    Route::get('notes/delete/{id}', 'StaffNotesController@delete');

    Route::resource('mcq', 'MCQController');
    Route::get('mcq/delete/{id}', 'MCQController@delete');
    Route::get('mcq/publish/{id}', 'MCQController@publish');
    Route::get("mcq/student-attended/{id}","MCQController@showResult");
    Route::get("mcq/student-attended/{id}/{userId}","MCQController@showAnswer");
    Route::get("mcq/{subId}/calculate","MCQController@calculate");

    Route::get("/question/{mcqId}/create",'QuestionController@addData');
    Route::post("/question/{mcqId}/store",'QuestionController@store');
    Route::get("/question/{mcqId}/{id}/edit",'QuestionController@edit');
    Route::post("/question/{mcqId}/{id}/update",'QuestionController@update');
    Route::get("/question/{mcqId}/{id}/delete",'QuestionController@delete');
    Route::get("/question/{mcqId}/",'QuestionController@index');

    Route::resource('videos', 'StaffVideoController');
    Route::get('videos/delete/{id}', 'StaffVideoController@delete');
    
    Route::resource('assignment', 'StaffAssignmentController');
    Route::get('assignment/delete/{id}', 'StaffAssignmentController@delete');

    Route::get("view-assignment/{id}",'StaffAssignmentController@getSubmissions');
    Route::get("view-assignment-answer/{id}",'StaffAssignmentController@getAnswer');

    Route::resource('staffEvent', 'StaffEventController');
    Route::get('staffEvent/delete/{id}', 'StaffEventController@delete');

    Route::get("view-registred/{id}","StaffEventController@registred");

    Route::get("view-sent-notes","StaffNotesController@viewSentNotes")->name("viewSentNotes");
    Route::get("view-sent-notes/{id}/approve","StaffNotesController@approve")->name("approve");
    Route::get("view-sent-notes/{id}/reject","StaffNotesController@reject")->name("reject");
});

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');

    Route::resource('subject', 'SubjectController');
    Route::get('subject/delete/{id}', 'SubjectController@delete');

    Route::resource('events', 'AdminEventController');
    Route::get('events/delete/{id}', 'AdminEventController@delete');

    Route::get("view-registred/{id}","AdminEventController@registred");

    Route::resource('staff', 'AdminStaffController');
    Route::get('staff/delete/{id}', 'AdminStaffController@delete');

    Route::resource('scholarship', 'AdminScholarshipController');
    Route::get('scholarship/delete/{id}', 'AdminScholarshipController@delete');
});
