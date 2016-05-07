<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Project;

/**
 * Class PagesController
 *
 * The controller responsible for handling all incoming
 * basic page related requests.
 *
 * @author Robert Breckenridge (original)
 * @author Rick Boss (editor)
 *
 * @package App\Http\Controllers
 */
class PagesController extends Controller
{
	/**
	 * Renders the Index View
	 *
	 * @return view The index view
	 */
	public function home()
	{
		return view('pages.index');                 //resources/views/pages/index.blade.php
	}

	/**
	 * Renders the About View
	 *
	 * @return view The about view
	 */
	public function about()
	{
		return view('pages.about');                 //resources/views/pages/about.blade.php
	}
}
