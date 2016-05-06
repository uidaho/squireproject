<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


use App\Http\Requests;
use App\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Builder;
use Illuminate\Database\Schema\Blueprint;

class SettingsController extends Controller
{
    /**
     * Runs before every method in the class, useful for what's below.
     */
    public function __construct()
    {
        /**
         * This will require login for the entire controller and then return
         * the user back where they were going.
         */
        $this->middleware('auth');
    }


    /**
     * Sets up a variable to hold user settings
     * requests information from the settings.blade.php page
     * creates defaults if none exist
     * @return mixed
     */
    public function update(Request $request)
    {
        $settings = Settings::getUserSettings(Auth::user()->id);

        $this->validate($request, [
            'nickname'          => 'required',
        ]);
        
        Settings::where('user_id', Auth::user()->id)
                ->update(['nickname' => $request->input('nickname'), 
                          'enable_chat' => $request->input('enable_chat'),
                          'editor_font' => $request->input('editor_font'),
                          'editor_font_color' => $request->input('editor_font_color'),
                        ]);

        return redirect('/settings');
    }

    /**
     *
     * Simply gets the user settings to fill the settings page with pre-set settings
     * @return mixed
     *
     */

    public function view()
    {
        $settings = Settings::getUserSettings(Auth::user()->id);
        
        return view('settings.settings', ['settings' => $settings]);
    }
}