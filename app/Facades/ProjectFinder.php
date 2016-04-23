<?php
/**
 * Created by PhpStorm.
 * User: Rick
 * Date: 4/23/16
 * Time: 9:06 AM
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ProjectFinder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'projectfinder';
    }
}