<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {


        view()->composer('index', function ($view) {
            $user = auth('web')->user();
            if(!is_null($user)) {
                $user = auth('web')->user();
                $view->with('userCount', User::all()->count());
                $view->with('friendCount', $user->incomingRequests()->count());
                $view->with('auth', $user);
            }
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Interfaces\IUserRepository',
            'App\Repositories\UserRepository');
    }
}
