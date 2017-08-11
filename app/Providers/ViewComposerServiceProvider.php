<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Message;
use App\User;
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
                $view->with('friendCount', $user->incomingRequests()->count());
                $view->with('articleCount', Article::all()->count());
                $view->with('commentCount', Comment::all()->count());
                $view->with('messageCount', Message::all()->count());
                $view->with('userCount', User::all()->count());
                $view->with('topArticle', Article::orderBy('views','desc')->get()->first());
                $view->with('ratingArticle', Article::orderBy('rating','desc')->get()->first());
                $view->with('auth', $user);

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
