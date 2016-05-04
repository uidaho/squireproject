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
Route::get('project/follow/{project}', 'ProjectController@follow');
Route::get('project/unfollow/{project}', 'ProjectController@unFollow');
Route::get('project/request/join/{project}', 'ProjectController@requestMembership');
Route::get('project/request/cancel/{project}', 'ProjectController@cancelMembershipRequest');
Route::get('project/leave/{project}', 'ProjectController@leaveProject');
Route::patch('project/edit/image/{project}', 'ProjectController@editImage');
Route::patch('project/edit/title/{project}', 'ProjectController@editTitle');
Route::patch('project/edit/body/{project}', 'ProjectController@editBody');

/*------------------------------*
 *  Project Member Controller   *
 *------------------------------*/
Route::get('project/private/{project}', 'ProjectMembersController@view');
Route::post('project/request/accepted/{project}/{user}', 'ProjectMembersController@acceptMembershipRequest');
Route::delete('project/request/denied/{project}/{user}', 'ProjectMembersController@denyMembershipRequest');
Route::patch('project/promote/{project}/{member}', 'ProjectMembersController@promoteToAdmin');
Route::patch('project/demote/{project}/{member}', 'ProjectMembersController@demoteFromAdmin');
Route::delete('project/kick/{project}/{member}', 'ProjectMembersController@kickMember');
Route::patch('project/edit/banner/{project}', 'ProjectMembersController@editBanner');
Route::patch('project/edit/statement/{project}', 'ProjectMembersController@editStatement');
Route::patch('project/edit/customtab/{project}', 'ProjectMembersController@editCustomTab');


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
Route::get('editor/edit/{project}', 'EditorController@listFiles');
Route::get('editor/edit', 'EditorController@index');
Route::get('editor/list/{project}', 'EditorController@listFiles');
Route::get('editor/list', 'EditorController@index');
Route::get('editor/{projectname}/{filename}', 'EditorController@editFile');
Route::get('editor/{projectname}', 'EditorController@listFiles');
Route::get('editor', 'EditorController@index');

/*-----------------------*
 *  Profile Controller   *
 *-----------------------*/
 //Replace when profile gets added
Route::get('profile1', 'ProfileController@view');
//Change user to profile object
Route::delete('profile1/delete/{user}', 'ProfileController@deleteUser');

 
 /*-----------------------*
  *  Settings Controller  *
  *-----------------------*/
Route::get('/settings', 'SettingsController@view');
Route::post('/settings', 'SettingsController@update');

