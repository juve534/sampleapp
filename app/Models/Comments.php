<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public function posts()
    {
        return $this->belongsTo(Posts::class);
    }
}