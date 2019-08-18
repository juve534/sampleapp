<?php

declare(strict_types=1);

namespace App\Listeners;

use App\DataProvider\AddReviewIndexProviderInterface;
use App\Events\ReviewRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

final class ReviewIndexCreator implements ShouldQueue
{
    use InteractsWithQueue;

    /** @var AddReviewIndexProviderInterface */
    private $provider;

    /**
     * ReviewIndexCreator constructor.
     *
     * @param AddReviewIndexProviderInterface $provider
     *
     * @return void
     */
    public function __construct(AddReviewIndexProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Handle the event.
     *
     * @param ReviewRegistered $event
     *
     * @throws \Exception
     *
     * @return void
     */
    public function handle(ReviewRegistered $event)
    {
        $this->provider->addReview(
            $event->getId(),
            $event->getTitle(),
            $event->getContent(),
            $event->getCreatedAtEpoch(),
            $event->getTags(),
            $event->getUserId()
        );
    }
}
