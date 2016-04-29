<?php

namespace App\Providers;

//use App\Profile;
//use App\Policies\ProfilePolicy;
use App\Policies\ProjectMembersPolicy;
use App\Project;
use App\ProjectMember;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\ProjectComment' => 'App\Policies\ProjectCommentPolicy',
        Project::class => ProjectMembersPolicy::class,
        //Profile::class => ProfilePolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //
    }
}
