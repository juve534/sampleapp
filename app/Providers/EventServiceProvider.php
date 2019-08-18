<?php

namespace App\Providers;

use App\Events\ReviewRegistered;
use App\Listeners\ReviewIndexCreator;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        // 会員登録時のイベントリスナー
        'Illuminate\Auth\Event\Registered' => [
            'App\Listeners\RegisteredListener',
        ],
        // 口コミ投稿
        ReviewRegistered::class => [
            ReviewIndexCreator::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
