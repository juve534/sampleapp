<?php
/**
 * ブログ記事関連のリポジトリ.
 */
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Comments;
use App\Models\Posts;

class PostsRepository implements PostsRepositoryInterface
{
    /** @var Posts */
    private $posts;

    /** @var Comments */
    private $comments;

    public function __construct(Posts $posts, Comments $comments)
    {
        $this->posts = $posts;
        $this->comments = $comments;
    }

    /**
     * 記事データを全件取得.
     *
     * @return array
     */
    public function findPostsAll(): array
    {
        $postData = $this->posts::all();
        $postData->load('comments');

        return $postData->toArray();
    }

    /**
     * 記事データと紐づくコメントを取得.
     *
     * @param int $id
     *
     * @return array
     */
    public function findByIdAndComments(int $id): array
    {
        $postData = $this->posts::findOrFail($id);
        $postData->load('comments');

        return $postData->toArray();
    }
}
