<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Project;

class PagesController extends Controller
{
	/*
	 * Route to each html page
	 */
	public function home()
	{
		return view('pages.index');                 //resources/views/pages/index.blade.php
	}

	public function about()
	{
		return view('pages.about');                 //resources/views/pages/about.blade.php
	}
}
