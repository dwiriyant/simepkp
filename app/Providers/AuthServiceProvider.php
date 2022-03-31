<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isSuperAdmin', function($user) {
            return $user->Role->code == 'super-admin';
        });

        Gate::define('isHeadOfficeAdmin', function($user) {
            return $user->Role->code == 'head-office-admin';
        });

        Gate::define('isBranchOfficeAdmin', function($user) {
            return $user->Role->code == 'branch-office-admin';
        });

        Gate::define('isBranchManager', function($user) {
            return $user->Role->code == 'branch-manager';
        });

        Gate::define('isSupervisor', function($user) {
            return $user->Role->code == 'supervisor';
        });

        Gate::define('isCreditManager', function($user) {
            return $user->Role->code == 'credit-manager';
        });

        Gate::define('isCreditCollection', function($user) {
            return $user->Role->code == 'credit-collection';
        });
        
    }
}
