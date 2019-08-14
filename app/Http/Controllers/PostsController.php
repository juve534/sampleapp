<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostsResource;
use App\Models\Posts;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $data = Posts::all();
        return JsonResponse::create($data);
    }
        return new PostsResource($data);
    }
}
