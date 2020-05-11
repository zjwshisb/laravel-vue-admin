<?php

namespace App\Providers;

use App\Auth\AdminGuard;
use App\Auth\AdminProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Auth::extend('admin', function ($app, $name, array $config) {
            return new AdminGuard(Auth::createUserProvider($config['provider']), request());
        });
        Auth::provider('admin', function ($app, array $config) {
            return new AdminProvider(new BcryptHasher(),$config['model']);
        });
    }
}
