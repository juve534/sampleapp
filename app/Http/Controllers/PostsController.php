<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostsResource;
use App\Models\Posts;
use App\Repositories\PostsRepositoryInterface as PostsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $data = Posts::all();
        return JsonResponse::create($data);
    }

    public function show(PostsRepository $postsRepository, Request $request)
    {
        $data = $postsRepository->findByIdAndComments((int) $request->id);
        return new PostsResource($data);
    }
}
