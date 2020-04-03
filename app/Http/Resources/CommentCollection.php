<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
           "id" => $this->id, 
           "img" => $this->img,
           "caption" => $this->caption,
           "user_username" => $this->user->username,
           "user_img" => $this->user->img,
        ];
    }
}

