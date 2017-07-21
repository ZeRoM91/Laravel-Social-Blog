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
                $view->with('message', $user->messagesTo()->unread()->count());
                $view->with('friend', $user->incomingRequests()->count());
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
