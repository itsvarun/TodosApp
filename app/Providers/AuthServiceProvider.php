<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Todo;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Todo' => 'App\Policies\TodoPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-todo', function (User $user, Todo $todo) {
            return $user->id == $todo->user_id;
        });

        /*Gate::before(function ($user) {
            return false;
        });*/

        /*Gate::after(function ($user) {
            return false;
        });*/

    }
}
