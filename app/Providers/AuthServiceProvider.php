<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Policies\CertPolicy;
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
        'App\Cert' => 'App\Policies\CertPolicy',
        'App\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('create-cert', 'App\Policies\CertPolicy@create');
        Gate::define('manager-user', 'App\Policies\UserPolicy@manager');
    }
}
