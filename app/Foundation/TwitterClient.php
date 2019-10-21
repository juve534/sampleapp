<?php

declare(strict_types=1);

namespace App\Foundation;

use mpyw\Cowitter\Client;

class TwitterClient implements TwitterClientInterface
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(string $consumerKey, string $consumerSecret, string $accessToken, string $accessTokenSecret)
    {
        $this->client = new Client(
            [
                $consumerKey,
                $consumerSecret,
                $accessToken,
                $accessTokenSecret,
            ]
        );
    }

    public function get(string $search, int $count): array
    {
        $params = [
            'q'     => $search,
            'count' => $count,
        ];

        return $this->client->get('search/tweets', $params)->statuses;
    }
}
