<?php

declare(strict_types=1);

namespace App\Foundation;

use GuzzleHttp\ClientInterface as Client;

class SendSlack implements SendSlackInterface
{
    /**
     * @var Client
     */
    private $client;

    private $webHookUrl;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->webHookUrl = env('WEB_HOOK_URL');
    }

    public function sendText(string $text)
    {
        $options = [
            'json' => [
                'username'    => 'Bot',
                'text'        => $text,
                'channel'     => env('SLACK_CHANNEL'),
            ],
        ];

        return $this->client->post($this->webHookUrl, $options);
    }

    public function sendImg(string $text, string $url)
    {
        $options = [
            'json' => [
                'username'    => 'Bot',
                'text'        => $text,
                'channel'     => env('SLACK_CHANNEL'),
                'attachments' => [
                    [
                        'image_url' => $url,
                    ],
                ],
            ],
        ];

        return $this->client->post($this->webHookUrl, $options);
    }
}
