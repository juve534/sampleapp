<?php

declare(strict_types=1);

namespace App\Repositories;

interface PostsRepositoryInterface
{
    /**
     * 記事データを全件取得.
     *
     * @return array
     */
    public function findPostsAll(): array;
}
