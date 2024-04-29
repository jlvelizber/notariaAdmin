<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('access.roles', function ($user) {
            return $user->role === 'administrator';
        });
    
        Gate::define('access.users', function ($user) {
            return $user->role === 'administrator';
        });
    
        Gate::define('access.requests', function ($user) {
            return in_array($user->role, ['administrator', 'secreatary', 'notary']);
        });
    
        Gate::define('access.settings', function ($user) {
            return $user->role === 'administrator';
        });
    }
}
