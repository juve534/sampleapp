<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Responders\Posts\PostsShowJsonResponder;
use App\Repositories\PostsRepositoryInterface as PostsRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * @OA\Info(title="PostAPI", version="1.0")
 */
/**
 * @OA\Schema(
 *   schema="posts",
 *   type="object",
 *   description="参照用",
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     description="ブログID"
 *   ),
 *   @OA\Property(
 *     property="title",
 *     type="string",
 *     description="ブログタイトル"
 *   ),
 *   @OA\Property(
 *     property="comments",
 *     type="object",
 *     description="コメント者一覧",
 *     @OA\Property(
 *       property="id",
 *       type="integer",
 *       description="コメントID"
 *     ),
 *     @OA\Property(
 *       property="commeter",
 *       type="string",
 *       description="コメントをした人"
 *     ),
 *     @OA\Property(
 *       property="body",
 *       type="string",
 *       description="コメント内容"
 *     )
 *   )
 * )
 */
final class ShowAction extends Controller
{
    /** @var PostsShowJsonResponder */
    private $responder;

    public function __construct(PostsShowJsonResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * @OA\Post(
     *   path="/api/v1/posts/{id}",
     *   summary="ブログ記事の情報を取得する.",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="ブログID",
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(@OA\Property(property="data", ref="#/components/schemas/posts"))
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Not Found"
     *   )
     * )
     */
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
