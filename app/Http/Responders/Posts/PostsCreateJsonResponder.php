<?php

declare(strict_types=1);

namespace App\Http\Responders\Posts;

use App\Models\Posts;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

final class PostsCreateJsonResponder
{
    /** @var ResponseFactory */
    private $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function respond(Posts $posts): JsonResponse
    {
        return $this->responseFactory->json($posts->toArray(), 200);
    }
}
