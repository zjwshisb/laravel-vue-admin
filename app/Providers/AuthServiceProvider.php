<?php

namespace App\Providers;

use App\Auth\BackendGuard;
use App\Auth\BackendUserProvider;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Auth;
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Auth::extend('backend',function ($app, $name, array $config){
            return new BackendGuard(Auth::createUserProvider($config['provider']),request());
        });

        Auth::provider('backend',function ($app, array $config){
            return new BackendUserProvider(new BcryptHasher(),$config['model']);
        });
    }
}
