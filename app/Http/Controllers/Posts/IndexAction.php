<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Responders\Posts\PostsIndexJsonResponder;
use App\Models\Posts;
use Illuminate\Http\JsonResponse;

final class IndexAction extends Controller
{
    /** @var PostsIndexJsonResponder */
    private $responder;

    public function __construct(PostsIndexJsonResponder $responder)
    {
        $this->responder = $responder;
    }

    public function __invoke(): JsonResponse
    {
        $data = Posts::all()->toArray();

        return $this->responder->respond($data);
    }
}
