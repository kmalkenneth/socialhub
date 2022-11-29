<?php

namespace App\Providers;

use App\Services\MastodonApi;
use App\Services\TwitterApi;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TwitterApi::class, function ($app) {
            return new TwitterApi();
        });

        $this->app->singleton(MastodonApi::class, function ($app) {
            return new MastodonApi();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
