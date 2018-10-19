<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::bind('post', function($value) {
            return \App\Post::where('id', $value)->orWhere('slug', $value)->first() ?? abort(404, 'Post doesn\'t exists!');
        });

        Route::bind('drafted_post', function($id) {
            return \App\Post::onlyDrafted()->findOrFail($id);
        });

        Route::bind('trashed_post', function($id) {
            return \App\Post::onlyTrashed()->findOrFail($id);
        });

        Route::bind('category', function($value) {
            return \App\Category::where('id', $value)->orWhere('slug', $value)->first() ?? abort(404, 'Category doesn\'t exists!');
        });

        Route::bind('tag', function($value) {
            return \App\Tag::where('id', $value)->orWhere('slug', $value)->first() ?? abort(404, 'Tag doesn\'t exists!');
        });

        Route::bind('role', function($value) {
            return \Spatie\Permission\Models\Role::where('id', $value)->orWhere('name', $value)->first() ?? abort(404, 'Role doesn\'t exists!');
        });

        Route::bind('permission', function($value) {
            return \Spatie\Permission\Models\Permission::where('id', $value)->orWhere('name', $value)->first() ?? abort(404, 'Permission doesn\'t exists!');
        });

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
        ->namespace($this->namespace)
        ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/api.php'));
    }
}
