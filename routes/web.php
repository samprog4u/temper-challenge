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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/auth/login', function () {
    return view('login');
});

Route::get('/auth/signup', function () {
    return view('register');
});

Route::get('/auth/confirmation_token', function () {
    return view('confirmation');
});

Route::get('/auth/user_profile', 'RegisterController@users');
Route::get('/auth/job_interest', 'RegisterController@jobs');
Route::get('/auth/job_experience', 'RegisterController@experience');
Route::get('/auth/freelancer', 'RegisterController@freelance');
Route::get('/auth/wait_approval', 'RegisterController@approval');
Route::get('/auth/completed', 'RegisterController@completed');
Route::get('/', 'WelcomeController@index');
Route::get('welcome', 'WelcomeController@index');
Route::get('logout', 'WelcomeController@logout');
Route::post('register', 'RegisterController@register');
Route::post('profile', 'RegisterController@profile');
Route::post('job_interested', 'RegisterController@job_interested');
Route::post('job_experienced', 'RegisterController@job_experienced');
Route::post('job_freelanced', 'RegisterController@job_freelanced');
Route::post('finished', 'RegisterController@finished');
Route::post('login', 'LoginController@login');
Route::get('activate/{id}', 'RegisterController@activate');
