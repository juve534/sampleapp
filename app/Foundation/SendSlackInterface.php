<?php

declare(strict_types=1);

namespace App\Foundation;

interface SendSlackInterface
{
    /**
     * Slackにテキストを送信する.
     *
     * @param string $text
     *
     * @return mixed
     */
    public function sendText(string $text);

    /**
     * Slackに画像を投稿する.
     *
     * @param string $text
     * @param $url
     *
     * @return mixed
     */
    public function sendImg(string $text, string $url);
}
