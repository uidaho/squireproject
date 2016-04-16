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


/*-----------------------*
 *  Project Controller   *
 *-----------------------*/
Route::get('project/create', 'ProjectController@createForm');
Route::post('project/create', 'ProjectController@create');
Route::get('project-create', 'ProjectController@createForm'); // TODO: deprecated
Route::post('project-create', 'ProjectController@create'); // TODO: deprecated
Route::get('project/delete/{project}', 'ProjectController@delete');
Route::get('projectfinder', 'PagesController@projectfinder'); // TODO: deprecated
Route::get('project', 'PagesController@projectfinder');
Route::get('project/view/{project}', 'ProjectController@view');
Route::get('project/{project}', 'ProjectController@view'); // overloads go last.

/*-----------------------*
 *  Editor Controller   *
 *-----------------------*/
Route::get('editor/create/{projectname}', 'EditorController@createView');
Route::post('editor/create/{projectname}', 'EditorController@create');
Route::get('editor/delete/{projectname}/{filename}', 'EditorController@delete');
Route::get('editor/edit/{projectname}/{filename}', 'EditorController@editFile');
Route::get('editor/{projectname}/{filename}', 'EditorController@editFile');
Route::get('editor/list/{projectname}', 'EditorController@listFiles');
Route::get('editor/{projectname}', 'EditorController@listFiles');
Route::get('editor', 'EditorController@index');
