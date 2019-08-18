<?php

declare(strict_types=1);

namespace App\DataProvider;

interface AddReviewIndexProviderInterface
{
    /**
     * レビューをクエリーに追加する.
     *
     * @param int    $id
     * @param string $title
     * @param string $content
     * @param string $epoch
     * @param int    $userId
     * @param array  $tags
     *
     * @return array
     */
    public function addReview(
        int $id,
        string $title,
        string $content,
        string $epoch,
        array $tags,
        int $userId
    ): array;
}
