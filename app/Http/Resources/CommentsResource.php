<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CommentsResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->resource['id'],
            'commenter' => $this->resource['commenter'],
            'body'      => $this->resource['body'],
        ];
    }
}
