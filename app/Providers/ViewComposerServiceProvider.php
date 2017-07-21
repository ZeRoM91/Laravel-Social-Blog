<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        //
        view()->composer('layouts.app', function ($view) {
            $user = auth('web')->user();

            if(!is_null($user)) {
                $view->with('messageCount', $user->messagesTo()->unread()->count());
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

    }
}
