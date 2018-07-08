<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('layouts.sidebar', function ($view) {
            $categories = \App\Category::has('posts')
                ->withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->take(10)
                ->get();

            $tags = \App\Tag::has('posts')
                ->withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->take(10)
                ->get();

            $comments = \App\Comment::with(['post', 'user'])
                ->latest()
                ->take(5)
                ->get();

            $view->with(compact('categories', 'comments', 'tags'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
