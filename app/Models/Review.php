<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Review.
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review query()
 * @mixin \Eloquent
 */
class Review extends Model
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
        'user_id',
        'title',
        'content',
    ];
}
