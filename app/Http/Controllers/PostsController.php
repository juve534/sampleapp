<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\PostsResource;
use App\Repositories\PostsRepositoryInterface as PostsRepository;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show(PostsRepository $postsRepository, Request $request)
    {
        $data = $postsRepository->findByIdAndComments((int) $request->id);

        return new PostsResource($data);
    }
}
