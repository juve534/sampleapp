<?php

declare(strict_types=1);

namespace App\DataProvider;

use App\Foundation\ElasticsearchClient;

final class AddReviewIndexDataProvider implements AddReviewIndexProviderInterface
{
    /** @var ElasticsearchClient */
    private $client;

    public function __construct(ElasticsearchClient $client)
    {
        $this->client = $client;
    }

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
    ): array {
        $params = [
            'index' => 'reviews',
            'type'  => 'reviews',
            'id'    => sprintf('reviews:%d', $id),
            'body'  => [
                'review_id' => $id,
                'title'     => $title,
                'content'   => $content,
                'tags'      => array_map(function (string $value) {
                    return [
                        'tag_name' => $value,
                    ];
                }, $tags),
                'user_id'    => $userId,
                'created_at' => $epoch,
            ],
        ];

        return $this->client->client()->index($params);
    }
}
