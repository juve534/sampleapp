<?php

declare(strict_types=1);

namespace App\Models;

use App\Constants\Cache;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Posts.
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts query()
 * @mixin \Eloquent
 *
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Comments[] $comments
 * @property mixed                                                           $cached_comments
 */
class Posts extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function getCachedCommentsAttribute()
    {
        $key = Cache::getCommentsCache(
            $this->getTable(),
            $this->getKey(),
            $this->updated_at->timestamp
        );

        return \Cache::remember($key, 1, function () {
            return $this->comments->toArray();
        });
    }
}
