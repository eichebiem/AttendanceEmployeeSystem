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

Route::group(['middleware' => ['auth', 'Role'], 'roles' => ['admin']], function () {
    Route::resource('/employees', 'EmployeeController');

    Route::get('/attendance', 'AttendanceController@index')->name('attendance');


    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin');


    Route::resource('/schedule', 'ScheduleController');


});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index')->name('home');



    Route::resource('/employees', 'EmployeeController', ['only' => [
        'show', 'index',
    ]]);

});

Route::get('/attendance/assign', function () {
    return view('attendance_leave_login');
})->name('attendance.login');

Route::post('/attendance/assign', 'AttendanceController@assign')->name('attendance.assign');
