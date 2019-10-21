<?php

declare(strict_types=1);

namespace App\Foundation;

interface TwitterClientInterface
{
    /**
     * 検索ワードでツイートを取得する.
     *
     * @param string $search
     * @param int    $count
     *
     * @return array
     */
    public function get(string $search, int $count): array;
}
