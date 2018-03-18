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
        'App\Models\Cert' => 'App\Policies\CertPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
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
        Gate::define('update-user', 'App\Policies\UserPolicy@update');
        Gate::define('edit-cert', 'App\Policies\CertPolicy@edit');
    }
}
