<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostsResource;
use App\Repositories\PostsRepositoryInterface as PostsRepository;
use Illuminate\Http\Request;

final class ShowAction extends Controller
{
    public function __invoke(PostsRepository $postsRepository, Request $request)
    {
        $data = $postsRepository->findByIdAndComments((int) $request->id);

        return new PostsResource($data);
    }
}
