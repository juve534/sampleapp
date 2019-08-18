<?php

declare(strict_types=1);

namespace App\DataProvider;

interface RegisterReviewProviderInterface
{
    /**
     * レビューを投稿する.
     *
     * @param string $title
     * @param string $content
     * @param int    $userId
     * @param string $createdAt
     * @param array  $tags
     *
     * @return int
     */
    public function registerReview(
        string $title,
        string $content,
        int $userId,
        string $createdAt,
        array $tags = []
    ): int;
}
