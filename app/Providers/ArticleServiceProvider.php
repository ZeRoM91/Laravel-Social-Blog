<?php

namespace App\Providers;


use App\Models\Article;

use Illuminate\Support\ServiceProvider;

class ArticleServiceProvider extends ServiceProvider
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

            $view->with('articleCount', Article::all()->count());
            $view->with('topArticle', Article::orderBy('views','desc')->get()->first());
            $view->with('ratingArticle', Article::orderBy('rating','desc')->get()->first());
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
            'App\Interfaces\IArticleRepository',
            'App\Repositories\ArticleRepository');
    }
}
