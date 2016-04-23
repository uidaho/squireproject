<?php

namespace App\Providers;

use App\Project;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ProjectFinderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!Cache::has('projects')) {
            Cache::rememberForever('projects', function() {
                return Project::all(['title', 'author']);
            });
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('projectfinder', function() {
            return new \App\Classes\ProjectFinder;
        });
    }
}
