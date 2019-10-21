<?php

declare(strict_types=1);

namespace App\Providers;

use App\DataProvider\AddReviewIndexDataProvider;
use App\DataProvider\RegisterReviewDataProvider;
use App\Foundation\ElasticsearchClient;
use Illuminate\Foundation\Application;
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

        $this->app->singleton(\App\Foundation\ElasticsearchClient::class, function (Application $app) {
            $config = $app['config']->get('elasticsearch');

            return new ElasticsearchClient($config['hosts']);
        });

        $this->app->bind(\App\DataProvider\AddReviewIndexProviderInterface::class, function () {
            return resolve(AddReviewIndexDataProvider::class);
        });

        $this->app->bind(
            \GuzzleHttp\ClientInterface::class,
            \GuzzleHttp\Client::class
        );
        $this->app->singleton(
            \App\Foundation\SendSlackInterface::class,
            \App\Foundation\SendSlack::class
        );
    }
}
