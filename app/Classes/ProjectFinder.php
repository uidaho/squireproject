<?php
/**
 * Created by PhpStorm.
 * User: Rick
 * Date: 4/23/16
 * Time: 9:02 AM
 */

namespace App\Classes;

use Illuminate\Support\Facades\Cache;

class ProjectFinder
{
    public function matching($search)
    {
        $entries = Cache::get('projects')->toArray();

        // Add the position to the entries
        $mapped = array_map(function($project) use($search) {
            $pos = strpos(strtolower($project['title']), strtolower($search));
            $project['position'] = $pos;
            return $project;
        }, $entries);

        // Filter out entries where position is false (does not contain string)
        $filtered = array_filter($mapped, function($project) { return $project['position'] !== FALSE; });

        return $filtered;
    }
}