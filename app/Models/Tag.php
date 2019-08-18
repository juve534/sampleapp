<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tag.
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag query()
 * @mixin \Eloquent
 */
class Tag extends Model
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
        'tag_name',
    ];
}
