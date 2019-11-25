<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\CreateRequest;
use App\Http\Responders\Posts\PostsCreateJsonResponder;
use App\Models\Posts;

final class CreateAction extends Controller
{
    /** @var PostsCreateJsonResponder */
    private $responder;

    /** @var Posts */
    private $model;

    public function __construct(PostsCreateJsonResponder $responder, Posts $model)
    {
        $this->responder = $responder;
        $this->model = $model;
    }

    public function __invoke(CreateRequest $request)
    {
        $title = $request->input('title');
        $body = $request->input('body');

        $post = $this->model::create(
            [
                'title' => $title,
                'body'  => $body,
            ]
        );

        return $this->responder->respond($post);
    }
}
