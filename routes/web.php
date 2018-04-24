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

Route::get('/', 'WelcomeController@index')->name('welcome');
//Route::get('/export', 'WelcomeController@export')->name('welcome_export');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('register/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::get('verify', 'Auth\VerifyController@verifyAccount')->name('verify');
Route::post('verify', 'Auth\VerifyController@handleVerifyAccount')->name('handle_verify');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home/user_profile/{user}', 'UserProfileController@show')->name('user_profile_show');
Route::get('/home/user_profile/{user}/pwd_change', 'UserProfileController@changePassword')->name('user_profile_change_password');
Route::post('/home/user_profile/{user}/pwd_change', 'UserProfileController@handleChangePassword')->name('user_profile_handle_change_password');
Route::get('/home/user_profile/{user}/update', 'UserProfileController@update')->name('user_profile_update');
Route::post('/home/user_profile/{user}/update', 'UserProfileController@handleUpdate')->name('user_profile_handle_update');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/user', 'UserController@list')->name('user');
Route::get('/home/user/add', 'UserController@add')->name('user_add');
Route::post('/home/user/add', 'UserController@handleAdd')->name('user_handle_add');
//Route::post('/home/user/search', 'UserController@handleSearch')->name('user_handle_search');
Route::get('/home/user/{user}', 'UserController@show')->name('user_show');
Route::get('/home/user/{user}/update', 'UserController@update')->name('user_update');
Route::post('/home/user/{user}/update', 'UserController@handleUpdate')->name('user_handle_update');
Route::get('/home/user/{user}/delete', 'UserController@delete')->name('user_delete');
Route::post('/home/user/{user}/delete', 'UserController@handleDelete')->name('user_handle_delete');
Route::get('/home/user/{user}/pwd_change', 'UserController@changePassword')->name('user_change_password');
Route::post('/home/user/{user}/pwd_change', 'UserController@handleChangePassword')->name('user_handle_change_password');

Route::get('/home/course_status', 'CoursestatusController@list')->name('course_status');
Route::get('/home/course_status/{coursestatus}', 'CoursestatusController@show')->name('course_status_show');
Route::get('/home/course_status/{coursestatus}/update', 'CoursestatusController@update')->name('course_status_update');
Route::post('/home/course_status/{coursestatus}/update', 'CoursestatusController@handleUpdate')->name('course_status_handle_update');

Route::get('/home/course_student_status', 'CoursestudentstatusController@list')->name('course_student_status');
Route::get('/home/course_student_status/{studentstatus}', 'CoursestudentstatusController@show')->name('course_student_status_show');
Route::get('/home/course_student_status/{studentstatus}/update', 'CoursestudentstatusController@update')->name('course_student_status_update');
Route::post('/home/course_student_status/{studentstatus}/update', 'CoursestudentstatusController@handleUpdate')->name('course_student_status_handle_update');

Route::get('/home/course', 'CourseController@list')->name('course');
Route::get('/home/course/add', 'CourseController@add')->name('course_add');
Route::post('/home/course/add', 'CourseController@handleAdd')->name('course_handle_add');
Route::get('/home/course/{course}', 'CourseController@show')->name('course_show');
Route::get('/home/course/{course}/update', 'CourseController@update')->name('course_update');
Route::post('/home/course/{course}/update', 'CourseController@handleUpdate')->name('course_handle_update');
Route::get('/home/course/{course}/delete', 'CourseController@delete')->name('course_delete');
Route::post('/home/course/{course}/delete', 'CourseController@handleDelete')->name('course_handle_delete');

Route::get('/home/course/{course}/scheme', 'CourseSchemeController@list')->name('course_scheme');

Route::get('/home/course_enrolled/', 'CourseEnrolledController@list')->name('course_enrolled');

Route::get('/home/course_managed/', 'CourseTeachingController@list')->name('course_managed');
Route::get('/home/course_managed/add', 'CourseTeachingController@add')->name('course_managed_add');
Route::post('/home/course_managed/add', 'CourseTeachingController@handleAdd')->name('course_managed_handle_add');
Route::get('/home/course_managed/{course}/ratee', 'CourseStudentController@show')->name('course_managed_student');
Route::get('/home/course_managed/{course}/ratee/add', 'CourseStudentController@add')->name('course_managed_student_add');
//Route::get('/home/course_managed/{course}/ratee/add2', 'CourseStudentController@show2')->name('course_managed_student_add');
Route::post('/home/course_managed/{course}/ratee/add', 'CourseStudentController@handleAdd')->name('course_managed_student_handle_add');
Route::get('/home/course_managed/{course}', 'CourseTeachingController@show')->name('course_managed_show');
Route::get('/home/course_managed/{course}/update', 'CourseTeachingController@update')->name('course_managed_update');
Route::post('/home/course_managed/{course}/update', 'CourseTeachingController@handleUpdate')->name('course_managed_handle_update');
Route::get('/home/course_managed/{course}/delete', 'CourseTeachingController@delete')->name('course_managed_delete');
Route::post('/home/course_managed/{course}/delete', 'CourseTeachingController@handleDelete')->name('course_managed_handle_delete');

Route::get('/home/course_managed/{course}/period', 'CoursePeriodController@list')->name('course_managed_period');
Route::get('/home/course_managed/{course}/period/add', 'CoursePeriodController@add')->name('course_managed_period_add');
Route::post('/home/course_managed/{course}/period/add', 'CoursePeriodController@handleAdd')->name('course_managed_period_handle_add');
Route::get('/home/course_managed/{course}/period/{period}', 'CoursePeriodController@show')->name('course_managed_period_show');
Route::get('/home/course_managed/{course}/period/{period}/update', 'CoursePeriodController@update')->name('course_managed_period_update');
Route::post('/home/course_managed/{course}/period/{period}/update', 'CoursePeriodController@handleUpdate')->name('course_managed_period_handle_update');
Route::get('/home/course_managed/{course}/period/{period}/delete', 'CoursePeriodController@delete')->name('course_managed_period_delete');
Route::post('/home/course_managed/{course}/period/{period}/delete', 'CoursePeriodController@handleDelete')->name('course_managed_period_handle_delete');

//Route::get('/home/course_managed/{course}/period/{period}/item', 'CoursePeriodController@update')->name('course_managed_period_item');
Route::get('/home/course_managed/{course}/period/{period}/item/add', 'CoursePeriodItemController@add')->name('course_managed_period_item_add');
Route::post('/home/course_managed/{course}/period/{period}/item/add', 'CoursePeriodItemController@handleAdd')->name('course_managed_period_item_hadle_add');
Route::get('/home/course_managed/{course}/period/{period}/item/{item}/delete', 'CoursePeriodItemController@delete')->name('course_managed_period_item_delete');


Route::get('/home/course_managed/{course}/scheme', 'CourseSchemeController@list')->name('course_managed_scheme');
Route::get('/home/course_managed/{course}/scheme/add', 'CourseSchemeController@add')->name('course_managed_scheme_add');
Route::post('/home/course_managed/{course}/scheme/add', 'CourseSchemeController@handleAdd')->name('course_managed_scheme_handle_add');
Route::get('/home/course_managed/{course}/scheme/{scheme}', 'CourseSchemeController@show')->name('course_managed_scheme_show');
Route::get('/home/course_managed/{course}/scheme/{scheme}/update', 'CourseSchemeController@update')->name('course_managed_scheme_update');
Route::post('/home/course_managed/{course}/scheme/{scheme}/update', 'CourseSchemeController@handleUpdate')->name('course_managed_scheme_handle_update');
Route::get('/home/course_managed/{course}/scheme/{scheme}/delete', 'CourseSchemeController@delete')->name('course_managed_scheme_delete');
Route::post('/home/course_managed/{course}/scheme/{scheme}/delete', 'CourseSchemeController@handleDelete')->name('course_managed_scheme_handle_delete');

Route::get('/home/usertype', 'UsertypeController@list')->name('usertype');
Route::get('/home/usertype/{usertype}', 'UsertypeController@show')->name('usertype_show');
Route::get('/home/usertype/{usertype}/update', 'UsertypeController@update')->name('usertype_update');
Route::post('/home/usertype/{usertype}/update', 'UsertypeController@handleUpdate')->name('usertype_handle_update');

Route::get('/home/userstatus', 'UserstatusController@list')->name('userstatus');
Route::get('/home/userstatus/{userstatus}', 'UserstatusController@show')->name('userstatus_show');
Route::get('/home/userstatus/{userstatus}/update', 'UserstatusController@update')->name('userstatus_update');
Route::post('/home/userstatus/{userstatus}/update', 'UserstatusController@handleUpdate')->name('userstatus_handle_update');