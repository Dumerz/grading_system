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

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('register/verify/{token}', 'Auth\RegisterController@verifyUser');

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
Route::get('/home/user/{user}', 'UserController@show')->name('user_show');
Route::get('/home/user/{user}/update', 'UserController@update')->name('user_update');
Route::post('/home/user/{user}/update', 'UserController@handleUpdate')->name('user_handle_update');
Route::get('/home/user/{user}/delete', 'UserController@delete')->name('user_delete');
Route::post('/home/user/{user}/delete', 'UserController@handleDelete')->name('user_handle_delete');
Route::get('/home/user/{user}/pwd_change', 'UserController@changePassword')->name('user_change_password');
Route::post('/home/user/{user}/pwd_change', 'UserController@handleChangePassword')->name('user_handle_change_password');

Route::get('/home/course_status', 'CourseController@list')->name('course_status');

Route::get('/home/course', 'CourseController@list')->name('course');
Route::get('/home/course/add', 'CourseController@add')->name('course_add');
Route::post('/home/course/add', 'CourseController@handleAdd')->name('course_handle_add');
Route::get('/home/course/{course}', 'CourseController@show')->name('course_show');

Route::get('/home/usertype', 'UsertypeController@list')->name('usertype');
Route::get('/home/usertype/{usertype}', 'UsertypeController@show')->name('usertype_show');
Route::get('/home/usertype/{usertype}/update', 'UsertypeController@update')->name('usertype_update');
Route::post('/home/usertype/{usertype}/update', 'UsertypeController@handleUpdate')->name('usertype_handle_update');

Route::get('/home/userstatus', 'UserstatusController@list')->name('userstatus');
Route::get('/home/userstatus/{userstatus}', 'UserstatusController@show')->name('userstatus_show');
Route::get('/home/userstatus/{userstatus}/update', 'UserstatusController@update')->name('userstatus_update');
Route::post('/home/userstatus/{userstatus}/update', 'UserstatusController@handleUpdate')->name('userstatus_handle_update');