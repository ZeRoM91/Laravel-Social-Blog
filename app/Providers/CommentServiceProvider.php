<?php

namespace App\Providers;


use App\Models\Comment;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('user', auth('web')->user());

        view()->composer('*', function ($view) {

            $view->with('commentCount', Comment::all()->count());

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
            'App\Interfaces\ICommentRepository',
            'App\Repositories\CommentRepository');
    }
}
