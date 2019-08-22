<?php

declare(strict_types=1);

namespace App\Constants;

final class Cache
{
    const CACHE_COMMENT = ':comments';

    public static function cacheKey(string $table, int $key, int $timestamp): string
    {
        return sprintf(
            '%s/%s-%s',
            $table,
            $key,
            $timestamp
        );
    }

    public static function getCommentsCache(string $table, int $key, int $timestamp): string
    {
        return self::cacheKey($table, $key, $timestamp) . self::CACHE_COMMENT;
    }
}
