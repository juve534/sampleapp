<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Http\JsonResponse;

final class IndexAction extends Controller
{
    public function index()
    {
        $data = Posts::all();

        return JsonResponse::create($data);
    }
}
