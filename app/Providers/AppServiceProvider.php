<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Check for specific route
            if (request()->is('register')) {
                $view->with('headerBase', 'show-header');
            }
        });

        $this->app->bind('all_users', function () {
            return User::all();
        });
    }
}
