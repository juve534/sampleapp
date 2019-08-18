<?php

declare(strict_types=1);

namespace App\Providers;

use App\DataProvider\RegisterReviewDataProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // PostsRepository
        $this->app->singleton(
            \App\Repositories\PostsRepositoryInterface::class,
            \App\Repositories\PostsRepository::class
        );

        $this->app->bind(\App\DataProvider\RegisterReviewProviderInterface::class, function () {
            return new RegisterReviewDataProvider();
        });
    }
}
