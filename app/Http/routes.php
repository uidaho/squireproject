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
Route::get('project/view/{projectname}', 'ProjectController@view');
Route::get('project/{projectname}', 'ProjectController@view'); // overloads go last.
Route::get('project/follow/{project}', 'ProjectController@addFollower');
Route::get('project/unfollow/{project}', 'ProjectController@removeFollower');
Route::get('project/request/join/{project}', 'ProjectController@requestMembership');
Route::get('project/request/cancel/{project}', 'ProjectController@removeMembershipRequest');
Route::post('project/request/accepted/{project}/{user}', 'ProjectController@acceptMembershipRequest');
Route::post('project/request/denied/{project}/{user}', 'ProjectController@denyMembershipRequest');
Route::get('project/leave/{project}', 'ProjectController@removeMember');

/*--------------------------------*
 *  Project Comments Controller   *
 *--------------------------------*/
Route::post('project/{project}/addComment', 'ProjectCommentsController@addComment');
Route::get('project/comments/edit/{projectComment}', 'ProjectCommentsController@editComment');
Route::patch('project/comments/update/{projectComment}', 'ProjectCommentsController@updateComment');
Route::delete('project/comments/{projectComment}', 'ProjectCommentsController@deleteComment');

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
<<<<<<< HEAD
Route::get('editor/edit/{projectname}', 'EditorController@listFiles');
Route::get('editor/edit', 'ProjectController@listProjects');
Route::get('editor/list/{projectname}', 'EditorController@listFiles');
Route::get('editor/list', 'ProjectController@listProjects');
=======
Route::get('editor/list/{project}', 'EditorController@listFiles');
>>>>>>> Added basic accepting and denying of project requests
Route::get('editor/{projectname}/{filename}', 'EditorController@editFile');
Route::get('editor/{projectname}', 'EditorController@listFiles');
Route::get('editor', 'EditorController@index');

/*-----------------------*
 *  Profile Controller   *
 *-----------------------*/
 
 
 /*-----------------------*
  *  Settings Controller  *
  *-----------------------*/
 
 
