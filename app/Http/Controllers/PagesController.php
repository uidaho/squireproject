<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

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

	public function projectfinder()
	{
		return view('pages.projectfinder', ['projects' => Project::all()]);         //resources/views/pages/projectfinder.blade.php
	}

	public function project($id)
	{
        return view('pages.project', ['project' => Project::find($id)]);
    }

	public function create()
	{
		return view('pages.create');
	}

	public function createProject()
	{
		$title = Request::input('title');
		$description = Request::input('description');
		$newEntry = Project::create([
			'author' => Auth::user()->username,
			'title'  => $title,
			'description' => $description
		]);
		return redirect('/project/' . $newEntry->id);
	}

	/*public function register()
	{
		return view('pages.register');             //resources/views/pages/register.blade.php
	}

	public function login()
	{
		return view('pages.login');                 //resources/views/pages/login.blade.php
	}*/

	/*public function reset()
	{
		return view('passwords.reset');
	}*/
}
