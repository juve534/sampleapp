<?php

declare(strict_types=1);

namespace App\Http\Responders\Posts;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

final class PostsIndexJsonResponder
{
    /** @var ResponseFactory */
    private $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function respond(array $posts = null): JsonResponse
    {
        if (is_null($posts)) {
            return $this->responseFactory->json(
                [
                    'error' => [
                        'type'    => 'not_found',
                        'message' => '見つかりません',
                    ],
                ], 404);
        }

        return $this->responseFactory->json($posts, 200);
    }
}
