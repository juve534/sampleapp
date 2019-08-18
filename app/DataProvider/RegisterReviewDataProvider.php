<?php

declare(strict_types=1);

namespace App\DataProvider;

use App\Events\ReviewRegistered;
use App\Models\Review;
use App\Models\ReviewTag;
use App\Models\Tag;

class RegisterReviewDataProvider implements RegisterReviewProviderInterface
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
     * @throws \Throwable
     *
     * @return int
     */
    public function registerReview(
        string $title,
        string $content,
        int $userId,
        string $createdAt,
        array $tags = []
    ): int {
        return \DB::transaction(
            function () use ($title, $content, $userId, $tags, $createdAt) {
                $reviewId = $this->createReview($title, $content, $userId, $createdAt);
                foreach ($tags as $tag) {
                    $this->createReviewTag(
                        $reviewId,
                        $this->createTag($tag, $createdAt),
                        $createdAt
                    );
                }

                return $reviewId;
            });
    }

    /**
     * タグIDを生成する.
     *
     * @param string $name
     * @param string $createdAt
     *
     * @return int
     */
    protected function createTag(string $name, string $createdAt): int
    {
        $tag = Tag::firstOrCreate(
            [
                'tag_name' => $name,
            ],
            [
                'created_at' => $createdAt,
            ]
        );

        return $tag->id;
    }

    /**
     * レビューIDを生成する.
     *
     * @param string $title
     * @param string $content
     * @param int    $userId
     * @param string $createdAt
     *
     * @return int
     */
    protected function createReview(
        string $title,
        string $content,
        int $userId,
        string $createdAt
    ): int {
        $review = Review::firstOrCreate(
            [
                'user_id' => $userId,
                'title'   => $title,
            ],
            [
                'content'    => $content,
                'created_at' => $createdAt,
            ]
        );

        return $review->id;
    }

    /**
     * レビューIDとタグIDを紐ける.
     *
     * @param int    $reviewId
     * @param int    $tagId
     * @param string $createdAt
     *
     * @return void
     */
    protected function createReviewTag(int $reviewId, int $tagId, string $createdAt): void
    {
        ReviewTag::firstOrCreate(
            [
                'review_id' => $reviewId,
                'tag_id'    => $tagId,
            ],
            [
                'created_at' => $createdAt,
            ]
        );
    }
}
