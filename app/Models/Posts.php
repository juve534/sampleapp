<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Posts
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Posts query()
 * @mixin \Eloquent
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
}
