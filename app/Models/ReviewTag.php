<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ReviewTag.
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewTag query()
 * @mixin \Eloquent
 */
class ReviewTag extends Model
{
    /**
     * @var bool
     *
     * @see Model::$timestamps
     */
    public $timestamps = false;

    /**
     * @var array
     *
     * @see Model::$fillable
     */
    protected $fillable = [
        'tag_id',
        'review_id',
    ];
}
