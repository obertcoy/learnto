<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton('firebase', function ($app) {
            $firebase = (new Factory)->withServiceAccount(config('firebase.credentials.path'));

            return $firebase;
        });

        $this->app->singleton('firebase.storage', function ($app) {
            return app('firebase')->createStorage();
        });
    }
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
