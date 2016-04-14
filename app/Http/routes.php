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

//Routes to pages with authentication
Route::auth();

//Routes to the different html pages
Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('projectfinder', 'PagesController@projectfinder');

/*-----------------------*
 *  Project Controller   *
 *-----------------------*/
Route::get('/project/{id}', 'ProjectController@view');
Route::get('/create', 'ProjectController@createProjectPage');
Route::post('/create', 'ProjectController@create');
Route::get('/delete-project/{id}', 'ProjectController@delete');

/*-----------------------*
 *  Editor Controller   *
 *-----------------------*/
Route::get('/editor/create/{projectname}', 'EditorController@createView');
Route::post('/editor/create/{projectname}', 'EditorController@create');
Route::get('/editor/delete/{projectname}/{filename}', 'EditorController@delete');
Route::get('/editor/{projectname}/{filename}', 'EditorController@editFile');
Route::get('/editor/{projectname}', 'EditorController@listFiles');
Route::get('/editor', 'EditorController@index');
