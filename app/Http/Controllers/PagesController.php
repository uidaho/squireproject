<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;


class PagesController extends Controller
{

	/*
	 * Route to each html page
	 */
	public function home()
	{
		return view('pages.index');                 //resources/views/pages/index.blade.php
	}

	public function register()
	{
		return view('pages.register');             //resources/views/pages/register.blade.php
	}

	public function login()
	{
		return view('pages.login');                 //resources/views/pages/login.blade.php
	}

	public function about()
	{
		return view('pages.about');                 //resources/views/pages/about.blade.php
	}

	public function projectfinder()
	{
		return view('pages.projectfinder');         //resources/views/pages/projectfinder.blade.php
	}
}
