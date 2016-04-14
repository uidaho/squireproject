<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*-------------------------
 * Routes Authentication
 * ------------------------
 */

// Authentication Routes...
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::post('loginemail', 'Auth\AuthControllerEmail@login');
Route::get('logout', 'Auth\AuthController@logout');

// Registration Routes...
Route::get('register', 'Auth\AuthController@showRegistrationForm');
Route::post('register', 'Auth\AuthController@register');

// Password Reset Routes...
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');

//Routes to the different html pages
Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('projectfinder', 'PagesController@projectfinder');

/*-----------------------*
 *  Project Controller   *
 *-----------------------*/
Route::get('/project/{project}', 'ProjectController@view');
Route::get('/project-create', 'ProjectController@createForm');        // can't do `/project/create` as it tries to find the project `create`
Route::post('/project-create', 'ProjectController@create');
Route::get('/project/{project}/delete', 'ProjectController@delete');

