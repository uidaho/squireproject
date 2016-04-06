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


/*
 * Routes Authentication
 */

Route::group(['middleware' => ['web']], function() {
    Route::auth();

    /*
    * Routes to the different html pages
    */

    Route::get('/', 'PagesController@home');

    Route::get('register', 'PagesController@register');

    Route::get('login', 'PagesController@login');

    Route::get('about', 'PagesController@about');

    Route::get('projectfinder', 'PagesController@projectfinder');
});

