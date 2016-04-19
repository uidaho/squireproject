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


/*-----------------------*
 *  Auth Controller      *
 *-----------------------*/
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::post('loginemail', 'Auth\AuthControllerEmail@login');
Route::get('logout', 'Auth\AuthController@logout');
Route::get('register', 'Auth\AuthController@showRegistrationForm');
Route::post('register', 'Auth\AuthController@register');
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');

/*-----------------------*
 *  Pages Controller     *
 *-----------------------*/
Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');


/*-----------------------*
 *  Project Controller   *
 *-----------------------*/
Route::get('project/create', 'ProjectController@createForm');
Route::post('project/create', 'ProjectController@create');
Route::get('project/delete/{project}', 'ProjectController@delete');
Route::get('project', 'ProjectController@listProjects');
Route::get('projects', 'ProjectController@listProjects');
Route::get('project/view/{project}', 'ProjectController@view');
Route::get('project/{project}', 'ProjectController@view'); // overloads go last.

/*--------------------------------*
 *  Project Comments Controller   *
 *--------------------------------*/
Route::post('project/{project}/comments', 'ProjectCommentsController@addComment');
Route::get('project/comments/edit/{projectComment}', 'ProjectCommentsController@editComment');
Route::patch('project/{project}/{projectComment}', 'ProjectCommentsController@updateComment');
Route::delete('project/{project}/comments/{projectComment}', 'ProjectCommentsController@deleteComment');
//Empty routes
Route::get('/project/comments', 'ProjectController@listProjects');
Route::get('/project/comment', 'ProjectController@listProjects');
Route::get('project/comments/edit', 'ProjectController@listProjects');

/*-----------------------*
 *  Editor Controller    *
 *-----------------------*/
Route::get('editor/create/{projectname}', 'EditorController@createView');
Route::post('editor/create/{projectname}', 'EditorController@create');
Route::get('editor/import/{projectname}', 'EditorController@importView');
Route::post('editor/import/{projectname}', 'EditorController@import');
Route::get('editor/export/{projectname}', 'EditorController@exportView');
Route::post('editor/export/{projectname}', 'EditorController@export');
Route::get('editor/rename/{projectname}/{filename}', 'EditorController@renameView');
Route::post('editor/rename/{projectname}/{filename}', 'EditorController@rename');
Route::get('editor/delete/{projectname}/{filename}', 'EditorController@deleteView');
Route::post('editor/delete/{projectname}/{filename}', 'EditorController@delete');
Route::get('editor/edit/{projectname}/{filename}', 'EditorController@editFile');
Route::get('editor/list/{projectname}', 'EditorController@listFiles');
Route::get('editor/{projectname}/{filename}', 'EditorController@editFile');
Route::get('editor/{projectname}', 'EditorController@listFiles');
Route::get('editor', 'EditorController@index');

/*-----------------------*
 *  Profile Controller   *
 *-----------------------*/
 
 
 /*-----------------------*
  *  Settings Controller  *
  *-----------------------*/
 
 
