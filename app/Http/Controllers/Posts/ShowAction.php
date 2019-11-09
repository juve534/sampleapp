<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Responders\Posts\PostsShowJsonResponder;
use App\Repositories\PostsRepositoryInterface as PostsRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

final class ShowAction extends Controller
{
    /** @var PostsShowJsonResponder */
    private $responder;

    public function __construct(PostsShowJsonResponder $responder)
    {
        $this->responder = $responder;
    }

    public function __invoke(PostsRepository $postsRepository, Request $request)
    {
        try {
            $data = $postsRepository->findByIdAndComments((int) $request->id);
        } catch (ModelNotFoundException $exception) {
            \Log::error($exception);
            $data = null;
        }

        return $this->responder->respond($data);
    }
}
