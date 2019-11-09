<?php

declare(strict_types=1);

namespace App\Http\Responders\Posts;

use App\Http\Resources\PostsResource;
use Illuminate\Contracts\Routing\ResponseFactory;

final class PostsShowJsonResponder
{
    /** @var ResponseFactory */
    private $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function respond(array $posts = null)
    {
        if (is_null($posts)) {
            return $this->responseFactory->json(
                [
                    'error' => [
                        'type'    => 'not_found',
                        'message' => '見つかりません',
                    ],
                ], 404)
                ->header('Content-Type', 'application/json');
        }

        return new PostsResource($posts);
    }
}
