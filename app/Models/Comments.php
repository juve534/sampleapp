<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Comments.
 *
 * @property \App\Models\Posts $posts
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comments query()
 * @mixin \Eloquent
 */
class Comments extends Model
{
    public function posts()
    {
        return $this->belongsTo(Posts::class);
    }
}
