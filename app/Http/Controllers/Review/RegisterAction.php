<?php

declare(strict_types=1);

namespace App\Http\Controllers\Review;

use App\DataProvider\RegisterReviewProviderInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class RegisterAction extends Controller
{
    /** @var RegisterReviewProviderInterface */
    private $provider;

    public function __construct(RegisterReviewProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(Request $request): Response
    {
        $this->provider->registerReview(
            $request->get('title'),
            $request->get('content'),
            $request->get('user_id', 1),
            Carbon::now()->toDateTimeString(),
            $request->get('tags')
        );

        return \response('', Response::HTTP_NO_CONTENT);
    }
}
