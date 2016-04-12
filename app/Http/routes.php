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

<<<<<<< Updated upstream
/*-------------------------
=======

/*
>>>>>>> Stashed changes
 * Routes Authentication
 */

Route::group(['middleware' => ['web']], function() {
    /*
     * Routes to pages with authentication
     */
    Route::auth();

    /*
    * Routes to the different html pages
    */

    Route::get('/', 'PagesController@home');

    Route::get('about', 'PagesController@about');

    Route::get('projectfinder', 'PagesController@projectfinder');

    Route::get('user_profile', 'PagesController@user_profile');

    Route::get('form', function(){
        return View::make('form');
    });

<<<<<<< Updated upstream
//Routes to the different html pages
Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('projectfinder', 'PagesController@projectfinder');

Route::get('/project/{title}', 'PagesController@project');
Route::get('/create', 'PagesController@create');
Route::post('/create', 'PagesController@createProject');
=======
    Route::any('form-submit', function(){
        var_dump(Input::file('file'));
    });
    //Route::get('register', 'PagesController@register');
    //Route::get('login', 'PagesController@login');
    //Route::get('reset', 'PagesContorller@reset');
});
>>>>>>> Stashed changes
