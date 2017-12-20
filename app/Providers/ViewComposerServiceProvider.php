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
        view()->share('user', auth('web')->user());

        view()->composer('layouts.app', function ($view) {
            $user = auth('web')->user();

            if(!is_null($user)) {

                $view->with('messageCount', $user->messagesTo()->unread()->count());
                $view->with('friendCount', $user->incomingRequests()->count());
                $view->with('auth', $user);

            }
        });

        view()->composer('index', function ($view) {
            $user = auth('web')->user();

            if(!is_null($user)) {
                $view->with('photo', $user->photos()->inRandomOrder()->first());


            }
        });
        view()->composer('lk.index', function ($view) {
            $user = auth('web')->user();

            if(!is_null($user)) {
                $view->with('status', $user->status()->value('status'));
                $view->with('friendsCount', $user->friends()->count());
                $view->with('articlesCount', $user->articles()->count());
                $view->with('commentsCount', $user->comments()->count());
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
