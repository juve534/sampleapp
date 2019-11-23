<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\CreateRequest;
use App\Http\Responders\Posts\PostsCreateJsonResponder;
use App\Models\Posts;
use App\Repositories\PostsRepositoryInterface as PostsRepository;

class CreateAction extends Controller
{
    /** @var PostsRepository */
    private $postsRepository;

    /** @var PostsCreateJsonResponder */
    private $responder;

    public function __construct(PostsRepository $postsRepository, PostsCreateJsonResponder $responder)
    {
        $this->postsRepository = $postsRepository;
        $this->responder = $responder;
    }

    public function __invoke(CreateRequest $request)
    {
        $title = $request->input('title');
        $body = $request->input('body');

        $post = Posts::create(
            [
                'title' => $title,
                'body'  => $body,
            ]
        );

        return $this->responder->respond($post);
    }
}
