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

Route::prefix('staff')->group(function() {
    Route::get('/login', 'Auth\StaffLoginController@showLoginForm')->name('staff.login');
    Route::post('/login', 'Auth\StaffLoginController@login')->name('staff.login.submit');
    Route::get('/dashboard', 'StaffController@index')->name('staff.dashboard');

    Route::resource('notes', 'StaffNotesController');
    Route::get('notes/delete/{id}', 'StaffNotesController@delete');

    Route::resource('videos', 'StaffVideoController');
    Route::get('videos/delete/{id}', 'StaffVideoController@delete');
    
    Route::resource('assignment', 'StaffAssignmentController');
    Route::get('assignment/delete/{id}', 'StaffAssignmentController@delete');
});

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');

    Route::resource('subject', 'SubjectController');
    Route::get('subject/delete/{id}', 'SubjectController@delete');

    Route::resource('events', 'AdminEventController');
    Route::get('events/delete/{id}', 'AdminEventController@delete');

    Route::resource('staff', 'AdminStaffController');
    Route::get('staff/delete/{id}', 'AdminStaffController@delete');

    Route::resource('scholarship', 'AdminScholarshipController');
    Route::get('scholarship/delete/{id}', 'AdminScholarshipController@delete');
});
