<?php

namespace App\Providers;


use App\Models\Message;
use App\User;
use Illuminate\Support\ServiceProvider;

class MessageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('user', auth('web')->user());

        view()->composer('index', function ($view) {

            $view->with('messageCount', auth('web')->user()->messages()->where('from_user_id', '<>', auth('web')->user()->id)->where('status', 0)->count());

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
            'App\Interfaces\IMessageRepository',
            'App\Repositories\MessageRepository');
    }

}
